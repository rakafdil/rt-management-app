<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penghuni extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penghuni';

    protected $fillable = [
        'nama_lengkap',
        'foto_ktp',
        'status_penghuni',
        'nomor_telepon',
        'status_menikah',
    ];

    protected $casts = [
        'status_menikah' => 'boolean',
    ];

    public function historiHuni(): HasMany
    {
        return $this->hasMany(HistoriHuni::class, 'penghuni_id');
    }

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'penghuni_id');
    }

    protected static function booted(): void
    {
        static::deleting(function (Penghuni $penghuni) {
            $penghuni->historiHuni()
                ->whereNull('tanggal_selesai')
                ->update(['tanggal_selesai' => now()]);
        });
    }
}