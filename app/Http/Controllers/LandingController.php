<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // return view('landing');
        $forms = Form::where('is_Active', true)->orderBy('order')->get();
        return view('landing', [
            'menu' => "Home",
            'forms' => $forms
        ]);    }
}
