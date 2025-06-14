<?php

namespace App\Http\Controllers\Admin\Sliders;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{
    public function addSlider (Request $req) {
        $req->all([
            'image' => 'required',
        ]);


        // Store Image
        // $filePath = $req->image->store('/sliders', 'public');
        // $filePath = Storage::url($filePath);
        $filename = time() . '.' . $req->image->getClientOriginalExtension();
$req->image->move(public_path('uploads/sliders'), $filename);

$filePath = 'uploads/sliders/' . $filename; // Save this path in DB

        // Cerate Slider
        Slider::create([
            'image' => $filePath,
        ]);

        // return
        return redirect()->route('sliders')->withSuccess('Slider created');
    }

    public function allSliders()
    {
        $data = Slider::paginate(15);
        return view('Admin.pages.Sliders.sliders', ['data' => $data]);
    }

    public function deleteSlider ($id)
    {
        // Delete
        Slider::findOrFail($id)->delete();

        // return
        return redirect()->back()->withSuccess('Slider Deleted');
    }

    public function addView ()
    {
        return view('Admin.pages.Sliders.add');
    }

}
