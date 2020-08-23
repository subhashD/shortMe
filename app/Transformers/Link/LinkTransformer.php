<?php

namespace App\Transformers\Link;
use App\Transformers\Transformer;
use App\Helpers\LinkHelper;

class LinkTransformer extends Transformer {
	
	public function transform($items) {
		return [
			"id" => $items->id,
	        "user_id" => $items->user_id,
	        "short_url" => LinkHelper::formatLink($items->short_url),
	        "long_url" => $items->long_url,
	        "long_url_hash" => $items->long_url_hash,
	        "is_disabled" => $items->is_disabled,
	        "created_at" => $items->created_at,
	        "updated_at" => $items->updated_at,
		];
	}
}