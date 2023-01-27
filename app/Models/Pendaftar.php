<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftar';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
    
    public function durasi()
    {
        return $this->belongsTo(Durasi::class);
    }
}
