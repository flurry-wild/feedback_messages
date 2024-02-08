<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class MessageStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:30',
            'message' => 'required|string|max:1500',
            'agreement' => 'required|string|in:true'
        ];
    }
}
