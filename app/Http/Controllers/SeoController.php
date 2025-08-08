<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap()
    {
        $urls = [
            [
                'url' => url('/'),
                'changefreq' => 'weekly',
                'priority' => '1.0'
            ],
            [
                'url' => url('/tools/qr'),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'url' => url('/tools/bmi'),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'url' => url('/tools/date-calculator'),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
            [
                'url' => url('/tools/password-generator'),
                'changefreq' => 'monthly',
                'priority' => '0.8'
            ],
        ];

        $sitemap = view('sitemap', compact('urls'))->render();

        return response($sitemap)
            ->header('Content-Type', 'application/xml');
    }

    public function robots()
    {
        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin\n";
        $robots .= "Disallow: /login\n";
        $robots .= "Disallow: /register\n";
        $robots .= "Disallow: /dashboard\n";
        $robots .= "Disallow: /settings\n";
        $robots .= "\n";
        $robots .= "Sitemap: " . url('/sitemap.xml');

        return response($robots)
            ->header('Content-Type', 'text/plain');
    }
}
