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
            'no_identitas' => ['required', Rule::unique('users', 'no_identitas')],
            'role_id' => 'required',
            'nama_lengkap' => 'required|unique:users,nama_lengkap',
            'password' => 'required',
        ],[
            'no_identitas.required' => 'Kolom NIM wajib diisi.',
            'no_identitas.unique' => 'NIM :value sudah terdaftar.',
            'role_id.required' => 'Kolom Role ID wajib diisi.',
            'nama_lengkap.required' => 'Kolom Username wajib diisi.',
            'nama_lengkap.unique' => 'Username :value sudah terdaftar.',
            'password.required' => 'Kolom Password wajib diisi.',
        ])->validate();

        // Enkripsi password
        $validatedData['password'] = Hash::make($validatedData['password']);

        return new User($validatedData);
    }
}