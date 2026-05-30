<?php

namespace App\Models;

use App\Enums\StatusHuni;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rumah extends Model
{
    use HasFactory;

    protected $table = 'rumah';

    protected $fillable = [
        'blok_nomor',
        'status_huni',
    ];

    protected $casts = [
        'status_huni' => StatusHuni::class,
    ];

    public function historiHuni(): HasMany
    {
        return $this->hasMany(HistoriHuni::class, 'rumah_id');
    }

    public function tagihan(): HasMany
    {
        return $this->hasMany(Tagihan::class, 'rumah_id');
    }

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'rumah_id');
    }

    public function getPenghuniAktifAttribute()
    {
        return $this->historiHuni()
            ->whereNull('tanggal_selesai')
            ->with('penghuni')
            ->first()
                ?->penghuni;
    }
}