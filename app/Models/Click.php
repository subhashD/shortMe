<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Link;

class Click extends Model
{
    protected  $table = 'clicks';

    public function link() {
        return $this->belongsTo(Link::class, 'link_id', 'id');
    }
}
