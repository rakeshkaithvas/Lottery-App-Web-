<?php

namespace App\Http\Controllers\Admin\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\GatewayFileds;
use App\Models\GeneralSetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function getGateways()
    {
        // get data
        $data = PaymentGateway::where('type', 'manual')->paginate(15);

        return view('Admin/pages/PaymentGateways/gateways', ['data' => $data]);
    }

    public function getAutoGateways()
    {
        // get data
        $data = PaymentGateway::where('type', 'auto')->paginate(15);

        return view('Admin/pages/PaymentGateways/automatic', ['data' => $data]);
    }

    public function addGetewayView ()
    {
        $setting = GeneralSetting::first();

        return view('Admin.pages.PaymentGateways.add', ['setting' => $setting]);
    }

    public function updateGetewayView ($id)
    {
        $setting = GeneralSetting::first();
        $gateway = PaymentGateway::find($id);

        return view('Admin.pages.PaymentGateways.update', ['setting' => $setting, 'gateway' => $gateway]);
    }

    public function updateGeteway (Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'fee' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'currency' => 'required|string',
            'rate' => 'required|numeric',
            'user_data.*.type' => 'required|string', // Ensure each user data entry type is a string
            'user_data.*.label' => 'required|string', // Ensure each user data entry label is a string
            'new_data.*.type' => 'required|string', // Ensure each new data entry type is a string
            'new_data.*.label' => 'required|string', // Ensure each new data entry label is a string
        ]);

        // Find the payment gateway
        $gateway = PaymentGateway::findOrFail($id);

        // Update gateway fields
        $gateway->update([
            'name' => $validatedData['name'],
            'currency' => $validatedData['currency'],
            'rate' => $validatedData['rate'],
            'min' => $validatedData['min'],
            'max' => $validatedData['max'],
            'fee' => $validatedData['fee'],
            'instruction' => $request->input('instruction'),
        ]);

        // Delete all previous dynamic user data fields
        $gateway->dynamicFields()->delete();

        // Create dynamic fields from existing user data
        if ($request->has('user_data')) {
            foreach ($request->user_data as $fieldId => $fieldData) {
                // Create a new dynamic field
                $gateway->dynamicFields()->create([
                    'field_type' => $fieldData['type'],
                    'field_name' => str_replace(' ', '_', $fieldData['label']),
                ]);
            }
        }

        // Create dynamic fields from existing user data
        if ($request->has('gateway_data')) {
            // Update dynamic fields (Gateway data)
            foreach ($request->gateway_data as $fieldId => $fieldValue) {
                $gatewayData = GatewayFileds::findOrFail($fieldId);
                $gatewayData->update(['field_value' => $fieldValue]);
            }

        }

        // Create dynamic fields from new data
        if ($request->has('new_data')) {
            foreach ($request->new_data as $fieldId => $fieldData) {
                // Create a new dynamic field
                $gateway->dynamicFields()->create([
                    'field_type' => $fieldData['type'],
                    'field_name' => str_replace(' ', '_', $fieldData['label']),
                ]);
            }
        }

        // Check if want to update logo, if so update logo
        if ($request->hasFile('logo')) {
            // Store logo
            // $filePath = $request->logo->store('/gateways', 'public');
            // $filePath = Storage::url($filePath);
            
                    $filename = time() . '.' . $request->logo->getClientOriginalExtension();
$request->logo->move(public_path('uploads/sliders'), $filename);

$filePath = 'uploads/sliders/' . $filename; // Save this path in DB

            PaymentGateway::find($id)->update(
                [
                    'logo' => $filePath,
                ]
            );
        }

        // Return
        return redirect()->back()->withSuccess('Succesfully Updated!');
    }

    public function activeInactiveGateway ($id)
    {
        // Get gateway
        $gateway = PaymentGateway::where('id', $id)->first();

        $gateway->update(
            [
                'status' => $gateway->status == 'active' ? 'inactive' : 'active',
            ]
        );

        return redirect()->back()->withSuccess('Gateway status changed');
    }

    public function deleteGateway($id)
    {
        // Delete Gateway
        PaymentGateway::where('id', $id)->delete();

        // return
        return back()->withSuccess('Gateway has been deleted');
    }

    public function addGateway(Request $req)
    {
        // validate
        $validatedData = $req->validate([
            'name' => 'required',
            'logo' => 'required|mimes:png,jpg,webp',
            'min' => 'required',
            'max' => 'required',
            'fee' => 'required',
            'currency' => 'required',
            'rate' => 'required',
            'user_data.*' => 'required|string', // Ensure each user data entry is a string
        ]);


        // Store logo
        // $filePath = $req->logo->store('/gateways', 'public');
        // $filePath = Storage::url($filePath);
        $filename = time() . '.' . $req->logo->getClientOriginalExtension();
$req->logo->move(public_path('uploads/sliders'), $filename);

$filePath = 'uploads/sliders/' . $filename; // Save this path in DB


        // Create Gateway
        $depositGateway = PaymentGateway::create([
            'name' => $req->name,
            'logo' => $filePath,
            'min' => $req->min,
            'max' => $req->max,
            'fee' => $req->fee,
            'rate' => $req->rate,
            'currency' => $req->currency,
            'instruction' => $req->instruction,
        ]);

        // Store dynamic user data fields
        foreach ($validatedData['user_data'] as $userData) {
            $userDataArray = json_decode($userData, true); // Convert JSON string to array
            $depositGateway->dynamicFields()->create([
                // 'deposit_gateway_id' => $depositGateway->id,
                'field_type' => $userDataArray['type'],
                'field_name' => str_replace(' ', '_', $userDataArray['label']),
            ]);
        }

        // return
        return redirect()->route('gateways')->withSuccess('Payment Gateway added');
    }

}
