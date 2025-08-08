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
});

// SEO routes
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
