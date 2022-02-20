<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];


    protected $fillable = ['razon', 'rif', 'tlf', 'email', 'password'];

    protected $hidden = [
        'password',
    ];


    public function postulaciones()
    {
        return $this->hasMany('App\Models\Postulacion');
    }
   

}
