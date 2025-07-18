<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riesgo;
use App\Models\Segura;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function reporteZonas()
    {
        
        $riesgos = Riesgo::all();
        $seguras = Segura::all();

        
        $pdf = Pdf::loadView('reportes.zonas_pdf', compact('riesgos', 'seguras'))
                  ->setPaper('a4', 'landscape'); // Formato horizontal

        // Descargar el archivo
        return $pdf->download('reporte_zonas.pdf');
    }
}
