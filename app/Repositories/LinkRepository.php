<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Models\Link;

class LinkRepository implements LinkRepositoryInterface
{
	public function get($link_id) {
		return Link::find($link_id);
	}

	public function getByCode($short_url) {
		return Link::where('short_url', $short_url)->first();
	}

	public function all() {
		return Link::orderByDesc('created_at')->get();
	}

	public function create(array $link_data) {
		return Link::create($link_data);
	}
	
	public function getByUser($user_id) {
		$query = Link::orderByDesc('created_at');
		
		if(!blank($user_id))
			$query = $query->where('user_id', $user_id);
		
		return $query->get();
	}

	public function delete($link_id) {
		return Link::destroy($link_id);
	}
	
	public function update($link_id, array $link_data) {
		return Link::find($link_id)->update($link_data);
	}

}