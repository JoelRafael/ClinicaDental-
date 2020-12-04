<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;



    protected $fillable=[
        'user_id',
        'nombre',
        'apellido',
        'pais_nacimiento',
        'ciudad_nacimiento',
        'documento',
        'direccion',
        'telefono',
        'telefono_emergencia'
    ];


public function user(){

    return $this->hasMany(User::class);
}

}
