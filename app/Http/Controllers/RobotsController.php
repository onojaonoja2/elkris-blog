<?php

namespace App\Http\Controllers;

class RobotsController extends Controller
{
    public function __invoke()
    {
        $content = "User-agent: *\nAllow: /\n\nSitemap: ".config('app.url').'/sitemap.xml';

        return response($content, 200, [
            'Content-Type' => 'text/plain',
        ]);
    }
}
