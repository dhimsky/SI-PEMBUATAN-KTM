<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required|min:8',
        ];
    }
    
    public function messages()
    {
        return [
            'current_password.required' => 'Kata sandi harus diisi!',
            'new_password.required' => 'Kata sandi baru harus diisi!',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter!',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok!',
            'new_password_confirmation.required' => 'Konfirmasi kata sandi baru harus diisi!',
            'new_password_confirmation.min' => 'Konfirmasi kata sandi baru minimal 8 karakter!',
        ];
    }
}