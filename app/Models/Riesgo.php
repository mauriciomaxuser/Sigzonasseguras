<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riesgo extends Model
{
    use HasFactory;

    protected $table = 'riesgos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'nivel_riesgo',
        'documento',
        'latitud',
        'longitud'
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here if needed
}