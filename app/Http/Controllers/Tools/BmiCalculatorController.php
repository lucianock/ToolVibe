<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class BmiCalculatorController extends Controller
{
    public function index()
    {
        return Inertia::render('Tools/BmiCalculator', [
            'meta' => [
                'title' => 'Calculadora de IMC Online - Índice de Masa Corporal - ToolVibe',
                'description' => 'Calcula tu Índice de Masa Corporal (IMC) de forma gratuita. Conoce si tu peso es saludable según tu altura y edad.',
                'keywords' => 'calculadora imc, indice masa corporal, peso ideal, bmi calculator',
                'url' => request()->url(),
            ]
        ]);
    }
}
