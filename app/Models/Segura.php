<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Segura extends Model
{
    use HasFactory;

    protected $table = 'zonasegura';

    protected $fillable = [
        'nombre',
        'radio',
        'latitud',
        'longitud',
        'tipo_seguridad'
    ];

    public $timestamps = true;

    // Define any relationships or additional methods here if needed
}