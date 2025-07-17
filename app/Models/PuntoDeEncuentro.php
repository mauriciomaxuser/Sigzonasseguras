<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoDeEncuentro extends Model
{
    use HasFactory;

    protected $table = 'puntos_de_encuentro'; // Asegúrate que este nombre coincida con tu base de datos

    protected $fillable = [
        'nombre',
        'capacidad',
        'responsable',
        'latitud',
        'longitud',
    ];
}
