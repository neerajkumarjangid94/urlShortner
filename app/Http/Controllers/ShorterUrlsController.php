<?php

namespace App\Http\Controllers;

use App\Models\ShortUrls;
use Illuminate\Http\Request;

class ShorterUrlsController extends Controller
{
    public function redirect($shortCode)
    {
        $shortUrl = ShortUrls::where('short_code', $shortCode)
            ->firstOrFail();

        return redirect()->away($shortUrl->original_url);
    }
}
