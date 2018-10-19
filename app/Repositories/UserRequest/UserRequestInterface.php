<?php

namespace App\Repositories\UserRequest;

interface UserRequestInterface
{
	public function save($request_id);

	public function getData($status);

	public function getCountRequest();

	public function deleteRequest($id);
}
