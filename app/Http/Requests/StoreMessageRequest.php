<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'message' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'mimes:doc,docx,ppt,pptx,xls,xlsx,pdf,png,jpg,jpeg', 'max:10240'],
        ];
    }
}
