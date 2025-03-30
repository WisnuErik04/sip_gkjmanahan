<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // return view('landing');
        $forms = Form::all();
        return view('landing', [
            'menu' => "Home",
            'forms' => $forms
        ]);    }
}
