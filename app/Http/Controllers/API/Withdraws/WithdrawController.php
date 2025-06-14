<?php

namespace App\Http\Controllers\API\Withdraws;

use App\Events\WithdrawRequestSentEvent;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Withdraw;
use App\Models\WithdrawGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{
    public function withdrawGateways()
    {
        $gateways = WithdrawGateway::with('dynamicFields')->where('status', 'active')->get();
        return response()->json($gateways);
    }

    public function createWithdraw(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'gateway_id' => 'required|exists:withdraw_gateways,id',
            'amount' => 'required',
        ]);

        // Get user
        $user = User::findOrFail(auth()->user()->id);

        // Fetch dynamic fields for the selected gateway
        $gateway = WithdrawGateway::findOrFail($validatedData['gateway_id']);
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
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Check if have suficient balance
        if ($request->amount > $user->balance) {
            return response()->json([
                'message' => 'You do not have sufficient balance!',
            ], 400);
        }

        // Check deposit amount is less than min amount
        if ($request->amount < $gateway->min) {
            return response()->json(['message' => 'Min withdraw is amount ' . number_format($gateway->min, 0)], 404);
        }

        // Check deposit amount is more than max amount
        if ($request->amount > $gateway->max) {
            return response()->json(['message' => 'Max withdraw is amount ' . number_format($gateway->max, 0)], 404);
        }

        $totalGatewayCurrencyAmount = $request->amount * $gateway->rate;


        // Calculate the fee in local currency
        $fee = ($gateway->fee / 100) * $totalGatewayCurrencyAmount;

        $getableAmount = $totalGatewayCurrencyAmount - $fee;

        // Update user balance
        User::where('id', $user->id)->decrement('balance', $request->amount);

        // Create withdraw record
        $withdraw = Withdraw::create([
            'user_id' => $user->id,
            'gateway_id' => $gateway->id,
            'amount' => $request->amount,
            'fee' => $fee,
            'getable_amount' => $getableAmount,
        ]);


        // Store user withdraw dynamic field data
        foreach ($dynamicFields as $field) {
            // Extract the field name from the object
            $fieldName = $field->field_name;

            // Check if the field value is null
            if (is_null($request->$fieldName)) {
                // Handle case where field is required but not provided
                return response()->json(['error' => "Field '{$fieldName}' is required."], 422);
            }

            // Get the value of the dynamic field from the request
            $fieldValue = $request->$fieldName;

            if ($field->field_type === 'file') {
                // Check if the file is present in the request
                if ($request->hasFile($fieldName)) {
                    // Store file and get its path
                    $filePath = $request->$fieldName->store('/withdraws', 'public');
                    $filePath = Storage::url($filePath);

                    // Create a record in the database with the file path as the field value
                    $withdraw->fields()->create([
                        'field_name' => $fieldName,
                        'field_value' => $filePath,
                    ]);
                } else {
                    // Handle case where file is required but not provided
                    return response()->json(['error' => "Field '{$fieldName}' is required as a file."], 422);
                }
            } else {
                // If the field type is not 'file', store the field value directly
                $withdraw->fields()->create([
                    'field_name' => $fieldName,
                    'field_value' => $fieldValue,
                ]);
            }
        }


        // Retrive updated withdraw
        $withdraw = Withdraw::where('id', $withdraw->id)->with('user')->with('gateway.dynamicFields')->first();

        // Trigger event to send email and push notification
        event(new WithdrawRequestSentEvent($withdraw));

        // Return success response
        return response()->json([
            'message' => 'Withdraw request submitted successfully.',
            'data' => $withdraw,
        ]);
    }

    public function withdrawHistory()
    {
        $history = Withdraw::where('user_id', auth()->user()->id)->with('gateway')->get();

        return response()->json(
            $history,
        );
    }
}
