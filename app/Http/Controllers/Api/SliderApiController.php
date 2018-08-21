<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SliderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSlider(Request $request, $name)
    {
        switch ($name) {
            case 'home-slider':
                $name = 'Home Slider';
        }
        $homeSlider = Slider::with('slides')->where('name', $name)->first();
        return response()->json($homeSlider, 200);
    }
}
