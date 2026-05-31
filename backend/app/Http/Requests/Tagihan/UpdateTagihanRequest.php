<?php

namespace App\Http\Requests\Tagihan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagihanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rumah_id' => [
                'required', 
                'exists:rumah,id'
            ],
            'nominal_tagihan' => ['sometimes', 'nullable', 'numeric', 'min:1'],
            'status_pembayaran' => ['sometimes', 'in:belum_bayar,sebagian,lunas'],
            'jenis_iuran_id' => ['required', 'exists:jenis_iuran,id'],
            'periode_bulan' => ['required', 'integer', 'between:1,12'],
            'periode_tahun' => ['required', 'integer', 'min:2000'],
        ];
    }
}