<?php

namespace App\Models;

use App\Models\Divisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;
    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
