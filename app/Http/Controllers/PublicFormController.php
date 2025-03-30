<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class PublicFormController extends Controller
{
    public function index()
    {
        // return view('landing');
        $forms = Form::all();
        return view('form-permohonan', [
            'menu' => "form-permohonan",
            'forms' => $forms
        ]);
    }
}
