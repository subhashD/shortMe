<?php

namespace App\Helpers;
use App\Models\Link;
use App\Models\Click;

class ClickHelper {
    static private function getHost($url) {
        // Return host given URL; NULL if host is
        // not found.
        return parse_url($url, PHP_URL_HOST);
    }
    
}