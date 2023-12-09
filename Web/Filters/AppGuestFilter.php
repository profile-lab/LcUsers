<?php

namespace LcUsers\Web\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
// 
use Config\Services;

class AppGuestFilter implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$appuser = Services::appuser();
		if ($appuser->user_id()) {
			return redirect()->route('web_dashboard');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
