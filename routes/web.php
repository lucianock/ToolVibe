<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Tools\QrGeneratorController;
use App\Http\Controllers\Tools\BmiCalculatorController;
use App\Http\Controllers\Tools\DateCalculatorController;
use App\Http\Controllers\Tools\PasswordGeneratorController;
use App\Http\Controllers\SeoController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'meta' => [
            'title' => 'ToolVibe - Herramientas Online Gratuitas',
            'description' => 'Descubre herramientas online gratuitas: generador de QR, calculadora IMC, calculadora de fechas y generador de contraseñas seguras.',
            'keywords' => 'herramientas online, generador qr, calculadora imc, herramientas gratis',
            'url' => request()->url(),
        ]
    ]);
})->name('home');

// Tools routes
Route::prefix('tools')->group(function () {
    Route::get('/qr', [QrGeneratorController::class, 'index'])->name('tools.qr');
    Route::post('/qr/generate', [QrGeneratorController::class, 'generate'])->name('tools.qr.generate');
    
    Route::get('/bmi', [BmiCalculatorController::class, 'index'])->name('tools.bmi');
    Route::get('/date-calculator', [DateCalculatorController::class, 'index'])->name('tools.date-calculator');
    Route::get('/password-generator', [PasswordGeneratorController::class, 'index'])->name('tools.password-generator');
    
    Route::get('/unit-converter', function () {
        return Inertia::render('Tools/UnitConverter', [
            'meta' => [
                'title' => 'Convertidor de Unidades - ToolVibe',
                'description' => 'Convierte entre diferentes unidades de longitud, peso, volumen, temperatura, área y velocidad. Herramienta online gratuita y fácil de usar.',
                'keywords' => 'convertidor unidades, conversión unidades, calculadora conversión, herramientas online',
                'url' => request()->url(),
            ]
        ]);
    })->name('tools.unit-converter');
    
    Route::get('/percentage-calculator', function () {
        return Inertia::render('Tools/PercentageCalculator', [
            'meta' => [
                'title' => 'Calculadora de Porcentajes - ToolVibe',
                'description' => 'Calcula porcentajes, descuentos, aumentos, propinas y división de cuentas. Herramienta online gratuita para cálculos matemáticos.',
                'keywords' => 'calculadora porcentajes, descuentos, aumentos, propinas, matemáticas online',
                'url' => request()->url(),
            ]
        ]);
    })->name('tools.percentage-calculator');
    
    Route::get('/color-generator', function () {
        return Inertia::render('Tools/ColorGenerator', [
            'meta' => [
                'title' => 'Generador de Colores - ToolVibe',
                'description' => 'Genera paletas de colores armónicas, convierte entre formatos de color y crea gradientes personalizados. Herramienta online para diseñadores.',
                'keywords' => 'generador colores, paletas colores, conversor colores, gradientes, diseño online',
                'url' => request()->url(),
            ]
        ]);
    })->name('tools.color-generator');
    
    Route::get('/time-calculator', function () {
        return Inertia::render('Tools/TimeCalculator', [
            'meta' => [
                'title' => 'Calculadora de Tiempo - ToolVibe',
                'description' => 'Calcula duraciones, fechas futuras, diferencias de tiempo y convierte entre unidades temporales. Herramienta online gratuita.',
                'keywords' => 'calculadora tiempo, duración fechas, conversión tiempo, herramientas online',
                'url' => request()->url(),
            ]
        ]);
    })->name('tools.time-calculator');
});

// SEO routes
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
