<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;


    protected $fillable=[

        'doctor_id',
        'nombre',
        'precio'
    ];

    protected $hidden=[
        'id',
        'created_at',
        'updated_at'
    ];
}
