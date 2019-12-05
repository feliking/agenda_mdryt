<?php

namespace App\Http\Chunk\GenerateReport;

class generateReport
{

    protected $type;

    public function generarReporte($reportType, $request)
    {
        // dd($request);
        $lookupArray = [
            'hojaruta' => 'hojaRutaReport',
            'cantidad' => 'cantidadReport',
            'infopro' => 'infoGralProdReport',
            'infoprodet' => 'infoGralProdDetReport',
            'infocom' => 'infoGralComReport',
            'infoemp' => 'infoGralEmpReport',
            'infoben' => 'infoGralBenReport',
            'guiaint' => 'guiaInternacionReport',
            'hojacom' => 'hojaRutaComReport',
            'volguia' => 'volGuiaIntReport',
            'volruta' => 'volHojaRutaReport',
            'volcom' => 'volCocaComReport',
            'voldepo' => 'volCocaDepo',
            'infoempind' => 'infoGralEmprReport',
            'infoinv' => 'infoGralInvReport',
            'canthojemp' => 'cantHojaEmpresaReport',
        ];
        $reportTypeArray = [
            'pdf' => 'ReportePDFController',
            'excel' => 'ReporteExcelController',
        ];        

        if( ! array_key_exists($reportType, $reportTypeArray)) {
            throw new \RuntimeException('Incorrect project type');
        }

        $className = "App\\Http\\Controllers\\" . $reportTypeArray[$reportType];
        return ( new $className )->{$lookupArray[$request['tipo']]}($request);
    }
}    