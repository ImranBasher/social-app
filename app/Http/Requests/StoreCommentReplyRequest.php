<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentReplyRequest extends FormRequest
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
            'comment_reply_body' => 'required|string',
            'post_id'            => 'required|exists:posts,id',
            'post_comment_id'    => 'required|exists:post_comments,id',
            'pic_name'           => 'nullable|image'
        ];
    }
}
