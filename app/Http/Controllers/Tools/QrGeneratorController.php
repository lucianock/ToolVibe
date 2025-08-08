<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrGeneratorController extends Controller
{
    public function index()
    {
        return Inertia::render('Tools/QrGenerator', [
            'meta' => [
                'title' => 'Generador de Códigos QR Online Gratis - ToolVibe',
                'description' => 'Genera códigos QR gratis y rápido. Crea códigos QR para URLs, texto, teléfonos, emails y más. Descarga en formato PNG de alta calidad.',
                'keywords' => 'generador qr, codigo qr, qr generator, crear qr, qr gratis',
                'url' => request()->url(),
            ]
        ]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:2048',
            'size' => 'integer|min:100|max:1000'
        ]);

        $text = $request->input('text');
        $size = $request->input('size', 300);

        $qrCode = QrCode::format('png')
                       ->size($size)
                       ->generate($text);

        return response($qrCode)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="qr-code.png"');
    }
}
