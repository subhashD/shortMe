<?php
namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface LinkRepositoryInterface
{
	public function get($link_id);

	public function all();

	public function getByCode(string $short_url);
	
	public function create(array $link_data);
	
	public function getByUser($user_id);

	public function delete($link_id);
	
	public function update($link_id, array $post_data);

}