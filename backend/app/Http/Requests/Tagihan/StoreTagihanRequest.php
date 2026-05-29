<?php

namespace App\Http\Requests\Tagihan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTagihanRequest extends FormRequest
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
            'jenis_iuran_id' => ['required', 'exists:jenis_iuran,id'],
            'periode_bulan' => ['required', 'integer', 'between:1,12'],
            'periode_tahun' => ['required', 'integer', 'min:2000'],
            'nominal_tagihan' => ['required', 'numeric', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'rumah_id.unique' => 'Tagihan untuk jenis iuran dan periode ini sudah ada untuk rumah tersebut.'
        ];
    }
}