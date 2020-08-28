<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\LinkRepositoryInterface;
use App\Models\Link;

class LinkRepository implements LinkRepositoryInterface
{
	protected $model = null;

	public function __construct(Link $link) {
		$this->model = $link;
	}
	
	public function get($link_id) {
		return $this->model->find($link_id);
	}

	public function getByCode(string $short_url) {
		return $this->model->where('short_url', $short_url)->first();
	}

	public function all() {
		return $this->model->orderByDesc('created_at')->get();
	}

	public function create(array $link_data) {
		return $this->model->create($link_data);
	}
	
	public function getByUser($user_id) {
		$query = $this->model->orderByDesc('created_at');
		
		if(!blank($user_id))
			$query = $query->where('user_id', $user_id);
		
		return $query->get();
	}

	public function delete($link_id) {
		return $this->model->destroy($link_id);
	}
	
	public function update($link_id, array $link_data) {
		return $this->model->find($link_id)->update($link_data);
	}

}