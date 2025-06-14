<?php

namespace App\Http\Controllers\API\DepositController;

use App\Events\DepositApproveEvent;
use App\Events\DepositRequestSentEvent;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\PaymentGateway;
use App\Models\Referral;
use App\Models\ReferSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    public function createDeposit (Request $req)
    {
        $req->validate([
            'gateway_id' => 'required',
            'amount' => 'required',
        ]);


        // Get user
        $user = User::find(auth()->user()->id);

        // Get refer setting
        $referSetting = ReferSetting::first();

        // Fetch the payment gateway by ID
        $gateway = PaymentGateway::where('id', $req->gateway_id)->where('status', 'active')->first();

        if (!$gateway) {
            return response()->json(['message' => 'Gateway not found'], 404);
        }

        $dynamicFields = $gateway->dynamicFields()->get(['field_name', 'field_type']);

        // Define validation rules for dynamic fields
        $rules = [];
        foreach ($dynamicFields as $field) {
            $rules[$field->field_name] = 'required'; // Field is required
            if ($field->field_type === 'file') {
                // If field type is 'file', add file validation rule
                $rules[$field->field_name] .= '|file';
            } elseif ($field->field_type !== 'text') {
                // If field type is not 'text', add string validation rule
                $rules[$field->field_name] .= '|string';
            }
        }

        // Perform validation
        $validator = Validator::make($req->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

             // Check if the gateway exists
             if (!$gateway) {
                return response()->json(['message' => 'Payment gateway not found'], 404);
            }

            // Check deposit amount is less than min amount
            if ($req->amount < $gateway->min)
            {
                return response()->json(['message' => 'Min deposit is amount '. $gateway->min], 404);
            }

            // Check deposit amount is more than max amount
            if ($req->amount > $gateway->max)
            {
                return response()->json(['message' => 'Max deposit is amount '. $gateway->max], 404);
            }

            // Calculate the fee in local currency
            $fee = ($gateway->fee / 100) * $req->amount;

            // Local currency amount after fee
            $amount = $req->amount - $fee;

            // Convert the user's deposit amount to the system currency using the exchange rate
            $amount = $amount / $gateway->rate;

            // Format the amount to two decimal places
            $amount = number_format($amount, 2, '.', '');



            // Create Deposit
            $deposit = Deposit::create([
                'gateway_id' => $gateway->id,
                'amount' => $amount,
                'total_amount' => $req->amount,
                'fee' => $fee,
                'user_id' => $user->id,
                'trx_id' => $req->trx_id,
                'status' => $gateway->type == 'manual' ? 'pending' : 'completed',
            ]);

            // Store user withdraw dynamic field data
            foreach ($dynamicFields as $field) {
                // Extract the field name from the object
                $fieldName = $field->field_name;

                // Check if the field value is null
                if (is_null($req->$fieldName)) {
                    // Handle case where field is required but not provided
                    return response()->json(['error' => "Field '{$fieldName}' is required."], 422);
                }

                // Get the value of the dynamic field from the request
                $fieldValue = $req->$fieldName;

                if ($field->field_type === 'file') {
                    // Check if the file is present in the request
                    if ($req->hasFile($fieldName)) {
                        // Store file and get its path
                        $filePath = $req->$fieldName->store('/deposits', 'public');
                        $filePath = Storage::url($filePath);

                        // Create a record in the database with the file path as the field value
                        $deposit->fields()->create([
                            'field_name' => $fieldName,
                            'field_value' => $filePath,
                        ]);
                    } else {
                        // Handle case where file is required but not provided
                        return response()->json(['error' => "Field '{$fieldName}' is required as a file."], 422);
                    }
                } else {
                    // If the field type is not 'file', store the field value directly
                    $deposit->fields()->create([
                        'field_name' => $fieldName,
                        'field_value' => $fieldValue,
                    ]);
                }
            }



            if ($gateway->type == 'manual')
            {
                event(new DepositRequestSentEvent($deposit, $gateway));
            } else {
                // Update user balance
                User::where('id', $deposit->user->id)->increment('balance', $deposit->amount);

                // Check if user is reffered by someone
                $reffered = Referral::where('referred_id', $user->id)->first();

                if (!empty($reffered)) {
                    // Check if deposit bonus is enabled
                    if ($referSetting->deposit_bonus) {

                        // Caluclate getable bonus amount from deposit amount
                        $commission = ($amount * $referSetting->deposit_percentage) / 100;

                        // Add balance to reffered user
                        User::where('id', $reffered->referrer_id)->increment('balance', $commission);
                    }
                }


                // call success event
                event(new DepositApproveEvent($deposit));
            }

            $setting = GeneralSetting::first();

            // currency
            $currency = $setting->currency;

            return response()->json([
                'message' => $gateway->type == 'manual' ? 'Deposit request has been sent to admin.' : "You request has been successful. Amount $amount $currency was added to your account.",
                'data' => $deposit,
            ]);
    }

    public function depositHistory ()
    {
        $history = Deposit::where('user_id', auth()->user()->id)->with('gateway')->get();

        return response()->json(
            $history,
        );
    }

    public function getGateways ()
    {
        $data = PaymentGateway::where('status', 'active')->with('data')->with('dynamicFields')->get();
        return response()->json($data);
    }

}
