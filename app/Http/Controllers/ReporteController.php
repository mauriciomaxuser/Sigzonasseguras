<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riesgo;
use App\Models\Segura;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteController extends Controller
{
    public function reporteZonas()
    {
        
        $riesgos = Riesgo::all();
        $seguras = Segura::all();
         
        $urlMapa = url('/puntos/global');

        
        // generar el QR como SVG
        $qrSvg = QrCode::format('svg')->size(200)->generate($urlMapa);

        $qrImage = 'data:image/svg+xml;base64,' . base64_encode($qrSvg);


        

        $pdf = Pdf::loadView('reportes.zonas_pdf', [
            'riesgos'  => $riesgos,
            'seguras'  => $seguras,
            'urlMapa'  => $urlMapa,
            'qrImage'  => $qrImage
        ])->setPaper('a4', 'landscape');

        return $pdf->download('reporte_zonas.pdf');


        // Descargar el archivo
        return $pdf->download('reporte_zonas.pdf');
    }
}
