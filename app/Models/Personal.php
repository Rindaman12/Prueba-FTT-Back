<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;


    protected $table="personal";

    protected $fillable = ['nombre', 'email', 'tlf', 'descripcion','cargo_id', 'anos'];

    public function cargo()
    {
        return $this->hasOne('App\Models\Cargo');
    }
}
