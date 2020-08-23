<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';
    protected $fillable = ['user_id', 'short_url', 'long_url', 'long_url_hash', 'is_disabled'];


    public function scopeLongUrl($query, $long_url) {
        // Allow quick lookups with Link::longUrl that make use
        // of the indexed crc32 hash to quickly fetch link
        $crc32_hash = sprintf('%u', crc32($long_url));

        return $query
            ->where('long_url_hash', $crc32_hash)
            ->where('long_url', $long_url);
    }
}
