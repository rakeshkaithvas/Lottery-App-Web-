<?php

namespace App\Http\Controllers\Admin\Withdraws;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\WithdrawGateway;
use App\Models\WithdrawGatewayDynamicField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WithdrawGatewayController extends Controller
{
    public function getAllGateways ()
    {
        $data = WithdrawGateway::paginate(15);

        return view('Admin.pages.Withdraws.withdraw_gateways', ['data' => $data]);
    }

    public function addGatewayView ()
    {
        $setting = GeneralSetting::first();
        return view('Admin.pages.Withdraws.add', ['setting' => $setting]);
    }

    public function addGateway (Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'currency' => 'required|string',
            'rate' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'fee' => 'required|numeric',
            'user_data.*' => 'required|string', // Ensure each user data entry is a string
        ]);

        // Store logo
        // $filePath = $request->logo->store('/gateways', 'public');
        // $filePath = Storage::url($filePath);
                $filename = time() . '.' . $request->logo->getClientOriginalExtension();
$request->logo->move(public_path('uploads/sliders'), $filename);

$filePath = 'uploads/sliders/' . $filename; // Save this path in DB

        // Create a new withdrawal gateway
        $withdrawalGateway = WithdrawGateway::create([
            'name' => $validatedData['name'],
            'currency' => $validatedData['currency'],
            'rate' => $validatedData['rate'],
            'min' => $validatedData['min'],
            'max' => $validatedData['max'],
            'fee' => $validatedData['fee'],
            'instruction' => $request->input('instruction'),
            'logo' => $filePath,
        ]);

        // Store dynamic user data fields
        foreach ($validatedData['user_data'] as $userData) {
            $userDataArray = json_decode($userData, true); // Convert JSON string to array
            $withdrawalGateway->dynamicFields()->create([
                'withdraw_gateway_id' => $withdrawalGateway->id,
                'field_type' => $userDataArray['type'],
                'field_name' => str_replace(' ', '_', $userDataArray['label']),
            ]);
        }

        // Redirect back with success message
        return redirect()->back()->withSuccess('Withdraw gateway created successfully.');

    }

    public function updateGetewayView ($id)
    {
        $setting = GeneralSetting::first();
        $gateway = WithdrawGateway::where('id', $id)->with('dynamicFields')->first();

        return view('Admin.pages.Withdraws.update', ['setting' => $setting, 'gateway' => $gateway]);
    }

    public function updateGeteway (Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'currency' => 'required|string',
            'rate' => 'required|numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'fee' => 'required|numeric',
            'user_data.*.type' => 'required|string', // Ensure each user data entry type is a string
            'user_data.*.label' => 'required|string', // Ensure each user data entry label is a string
            'new_data.*.type' => 'required|string', // Ensure each new data entry type is a string
            'new_data.*.label' => 'required|string', // Ensure each new data entry label is a string
        ]);

        // Find the withdrawal gateway by ID
        $gateway = WithdrawGateway::findOrFail($id);

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

        // Check if want to update logo, if so update logo
        if ($request->hasFile('logo')) {
            // Store logo
            $filePath = $request->logo->store('/gateways', 'public');
            $filePath = Storage::url($filePath);

            $gateway->update(
                [
                    'logo' => $filePath,
                ]
            );
        }


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

        // Redirect back with success message
        return redirect()->back()->withSuccess('Withdraw gateway updated successfully.');
    }

    public function activeInactiveGateway ($id)
    {
        // Get gateway
        $gateway = WithdrawGateway::where('id', $id)->first();

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
        WithdrawGateway::where('id', $id)->delete();

        // return
        return back()->withSuccess('Gateway has been deleted');
    }
}
