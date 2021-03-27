<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:5|max:25'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password baru tidak boleh kosong.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password harus 5 karakter minimum.',
            'password.max' => 'Password tidak boleh melebihi 25 karakter.'
        ];
    }
}
