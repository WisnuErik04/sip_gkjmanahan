<?php

namespace App\Http\Controllers\Api;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\FormPertanyaan;
use App\Models\ListUploadForm;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $forms = Form::select('id', 'name', 'content')->get();
            return response()->json([
                'status' => true,
                'message' => 'Formulir ditemukan',
                'data' => $forms
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Formulir tidak ditemukan',
                'data' => null
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $id = $request->id;
        try {
            $form = Form::select('id', 'name', 'content')->findOrFail($id);

            $pertanyaans = FormPertanyaan::select(
                'pertanyaan',
                'tipe_jawaban',
                'opsi_jawaban',
                'required',
                'order',
                'placeholder'
            )
                ->where('form_id', $id)->orderBy('order')->get();

            $listUploads = ListUploadForm::select(
                'id',
                'name',
                'order',
                'upload_type',
                'is_required'
            )
                ->where('form_id', $id)->orderBy('order')->get();

            return response()->json([
                'status' => true,
                'message' => 'Detail Formulir ditemukan',
                'data' => [
                    'detail' => $form,
                    'pertanyaans' => $pertanyaans,
                    'listUploads' => $listUploads
                ]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Detail Formulir tidak ditemukan',
                'data' => null
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan',
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
