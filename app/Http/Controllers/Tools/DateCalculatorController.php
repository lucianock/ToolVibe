<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DateCalculatorController extends Controller
{
    public function index()
    {
        return Inertia::render('Tools/DateCalculator', [
            'meta' => [
                'title' => 'Calculadora de Días Entre Fechas - ToolVibe',
                'description' => 'Calcula los días, semanas, meses y años entre dos fechas. Herramienta gratuita para calcular diferencias de tiempo.',
                'keywords' => 'calculadora fechas, dias entre fechas, diferencia fechas, calcular tiempo',
                'url' => request()->url(),
            ]
        ]);
    }
}
