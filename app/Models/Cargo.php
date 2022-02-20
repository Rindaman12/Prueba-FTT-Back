<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = ['cargo'];

    public function personal()
    {
        return $this->belongsTo('App\Models\Personal');
    }

    public function postulacion()
    {
        return $this->belongsTo('App\Models\Postulacion');
    }
}
