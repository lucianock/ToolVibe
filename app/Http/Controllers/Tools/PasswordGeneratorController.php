<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PasswordGeneratorController extends Controller
{
    public function index()
    {
        return Inertia::render('Tools/PasswordGenerator', [
            'meta' => [
                'title' => 'Generador de Contraseñas Seguras Online - ToolVibe',
                'description' => 'Genera contraseñas seguras y aleatorias. Personaliza longitud, caracteres especiales, números y mayúsculas para máxima seguridad.',
                'keywords' => 'generador contraseñas, password generator, contraseñas seguras, crear contraseña',
                'url' => request()->url(),
            ]
        ]);
    }
}
