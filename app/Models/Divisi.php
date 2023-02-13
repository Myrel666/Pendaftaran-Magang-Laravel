<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';
    protected $guarded = ['id'];

    public function pendaftar()
    {
        return $this->hasOne(Pendaftar::class);
    }

    public function divisi_formulir()
    {
        return $this->hasMany(Formulir::class);
    }
}
