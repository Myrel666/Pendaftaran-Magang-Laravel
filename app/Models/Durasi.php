<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Durasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'durasi';

    public function pendaftar()
    {
        return $this->hasOne(Pendaftar::class);
    }
}
