<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        //dd($this->all());
        return [
            'title'         => 'nullable|string',
            'post_body'     => 'required|string',
            'feeling_id'    => 'nullable|exists:feelings,id',
            'pic_name'      => 'nullable',
            'is_active'     => 'nullable',
        ];
    }
}
