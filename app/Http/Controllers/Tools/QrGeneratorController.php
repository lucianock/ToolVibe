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
            'size' => 'integer|min:100|max:1000',
            'format' => 'nullable|in:png,svg',
            'margin' => 'nullable|integer|min:0|max:10',
            'error_correction' => 'nullable|in:L,M,Q,H',
            'foreground' => ['nullable','regex:/^#?[0-9a-fA-F]{6}$/'],
            'background' => ['nullable','regex:/^#?[0-9a-fA-F]{6}$/'],
        ]);

        $text = $request->input('text');
        $size = (int) $request->input('size', 300);
        $format = $request->input('format', 'png');
        $margin = (int) $request->input('margin', 1);
        $errorCorrection = $request->input('error_correction', 'M');
        $foreground = $request->input('foreground', '#000000');
        $background = $request->input('background', '#ffffff');

        $hexToRgb = function (string $hex): array {
            $hex = ltrim($hex, '#');
            return [
                hexdec(substr($hex, 0, 2)),
                hexdec(substr($hex, 2, 2)),
                hexdec(substr($hex, 4, 2)),
            ];
        };

        [$fr, $fg, $fb] = $hexToRgb($foreground);
        [$br, $bg, $bb] = $hexToRgb($background);

        try {
            // Intentar generar con el formato solicitado
            $qr = QrCode::format($format)
                ->size($size)
                ->margin($margin)
                ->errorCorrection($errorCorrection)
                ->color($fr, $fg, $fb)
                ->backgroundColor($br, $bg, $bb)
                ->generate($text);

            $contentType = $format === 'svg' ? 'image/svg+xml' : 'image/png';
            $filename = $format === 'svg' ? 'qr-code.svg' : 'qr-code.png';

            return response($qr)
                ->header('Content-Type', $contentType)
                ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
        } catch (\Throwable $e) {
            // Fallback a SVG (no requiere extensiones de imagen)
            try {
                $qrSvg = QrCode::format('svg')
                    ->size($size)
                    ->margin($margin)
                    ->errorCorrection($errorCorrection)
                    ->color($fr, $fg, $fb)
                    ->backgroundColor($br, $bg, $bb)
                    ->generate($text);

                return response($qrSvg)
                    ->header('Content-Type', 'image/svg+xml')
                    ->header('Content-Disposition', 'attachment; filename="qr-code.svg"');
            } catch (\Throwable $e2) {
                // Respuesta de error en JSON para peticiones AJAX
                return response()->json([
                    'message' => 'No se pudo generar el código QR',
                    'errors' => [
                        'text' => 'No se pudo generar el código QR. Inténtalo de nuevo más tarde.'
                    ],
                ], 422);
            }
        }
    }
}
