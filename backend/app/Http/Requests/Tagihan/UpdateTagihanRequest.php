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
                'exists:rumah,id',
                Rule::unique('tagihan')->where(function ($query) {
                    return $query->where('jenis_iuran_id', $this->jenis_iuran_id)
                                 ->where('periode_bulan', $this->periode_bulan)
                                 ->where('periode_tahun', $this->periode_tahun);
                })
            ],
            'nominal_tagihan' => ['sometimes', 'numeric', 'min:1'],
            'status_pembayaran' => ['sometimes', 'in:belum_bayar,sebagian,lunas'],
        ];
    }
}