<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel, WithHeadingRow
{
    use HasFactory;
    
    public function model(array $row)
    {
        $validatedData = validator($row, [
            'nim' => ['required', Rule::unique('users', 'nim')],
            'role_id' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
        ],[
            'nim.required' => 'Kolom NIM wajib diisi.',
            'nim.unique' => 'NIM :value sudah terdaftar.',
            'role_id.required' => 'Kolom Role ID wajib diisi.',
            'username.required' => 'Kolom Username wajib diisi.',
            'username.unique' => 'Username :value sudah terdaftar.',
            'password.required' => 'Kolom Password wajib diisi.',
        ])->validate();

        // Enkripsi password
        $validatedData['password'] = Hash::make($validatedData['password']);

        return new User($validatedData);
    }
}