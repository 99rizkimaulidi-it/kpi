<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('karyawan');
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:doc,docx,ppt,pptx,xls,xlsx,pdf,png,jpg,jpeg', 'max:20480'],
        ];
    }

    public function validatedFile()
    {
        return $this->file('file');
    }
}
