<?php

namespace App\Models;

use App\Models\Karyawan;
use App\Models\Kompetensi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penilaian extends Model
{
    use HasFactory;
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function kompetensi()
    {
        return $this->belongsTo(Kompetensi::class);
    }
}
