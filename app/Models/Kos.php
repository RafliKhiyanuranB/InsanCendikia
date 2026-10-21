<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nm_kos', 'foto_kos', 'deskripsi_kos', 'tipe_kos', 'tipe'
    ];
}
