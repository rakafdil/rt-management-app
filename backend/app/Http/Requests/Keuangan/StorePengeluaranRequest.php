<?php

namespace App\Http\Requests\Keuangan;

use Illuminate\Foundation\Http\FormRequest;

class StorePengeluaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => ['nullable', 'exists:kategori_pengeluaran,id'],
            'nama_kategori' => ['nullable', 'string', 'max:100'],

            'deskripsi' => ['required', 'string'],
            'nominal' => ['required', 'numeric', 'min:1'],
            'tanggal_pengeluaran' => ['required', 'date'],
        ];
    }
}