<?php

namespace LcUsers\Web\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
// 
use Config\Services;

class LcUsersAuth implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$users = Services::users();
		if (!$users->user_id()) {
			return redirect()->route('web_login');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
