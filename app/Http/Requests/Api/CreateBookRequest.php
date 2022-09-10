<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'title' => 'required|min:3|unique:books',
            'description' => 'required|min:10',
            'user_id' => 'required'
        ];
    }


    public function attributes()
    {
        return [
            'title' => 'Title',
            'description' => 'Description',
            'user_id' => 'User'
        ];
    }
}
