<?php

namespace App\Http\Controllers\API\Sliders;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    public function index ()
    {
        $sliders = Slider::all();
        return response()->json($sliders);
    }
}
