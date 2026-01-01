<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['co-admin', 'super-admin']);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'deadline_at' => ['required', 'date'],
            'assignee_id' => ['required', 'exists:users,id'],
            'files.*' => ['sometimes', 'file', 'mimes:doc,docx,ppt,pptx,xls,xlsx,pdf,png,jpg,jpeg', 'max:20480'],
        ];
    }

    public function validatedFiles(): array
    {
        return $this->file('files', []);
    }
}
