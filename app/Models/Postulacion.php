<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    protected $table="postulaciones";


    protected $fillable = ['empresa_id', 'cargo_id', "anos"];


    public function empresas()
    {
        return $this->hasOne('App\Models\Empresa');
    }

    public function cargo()
    {
        return $this->hasOne('App\Models\Cargo');
    }

}
