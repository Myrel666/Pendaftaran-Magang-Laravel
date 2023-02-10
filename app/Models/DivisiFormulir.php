<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisiFormulir extends Model
{
    use HasFactory;

    protected $table = 'divisi_formulir';
    protected $guarded = ['id'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

}
