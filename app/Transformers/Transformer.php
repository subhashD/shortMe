<?php
namespace App\Transformers;

abstract class Transformer {

	public function transformCollection($items) {
		return $items->map([$this, 'transform']);
	}

	public function transformArray($items) {
		return array_map([$this, 'transform'], $items);
	}

	public abstract function transform($items);
}