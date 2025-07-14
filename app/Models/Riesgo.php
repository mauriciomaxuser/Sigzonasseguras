<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riesgo extends Model
{
    use HasFactory;

    protected $table = 'zonariesgo';

    protected $fillable = [
        'nombre',
        'descripcion',
        'nivel_riesgo',
        'documento',
        'latitud1',
        'longitud1',
        'latitud2',
        'longitud2',
        'latitud3',
        'longitud3',
        'latitud4',
        'longitud4'
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here if needed
}