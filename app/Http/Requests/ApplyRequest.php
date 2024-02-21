<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'job_id' => 'required|numeric|integer|min:1',
            'name' => 'required',
            'email' => 'required|email:rfc|unique:candidates,email',
            'phone' => 'required|numeric|unique:candidates,phone|min:0',
            'year' => 'required|numeric',
            'skillset' => 'required'
        ];
    }
}
