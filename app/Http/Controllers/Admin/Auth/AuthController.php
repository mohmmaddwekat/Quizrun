<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;

class AuthController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	/**
	 * Render views with admin Auth layout
	 *
	 * @param string $page View file path not including 'admin/auth'
	 * @param string $page_title Page title
	 * @param array $controller_data Passed data
	 * @return void
	 */
	public function adminAuthTemplate($page, $page_title, $data = [])
	{
		// prep.  data
		$theme = Cookie::get('theme');
		if ($theme != 'dark-mode' && $theme != 'light-mode') {
			$theme = 'light-mode';
		}
		$content['theme'] = $theme;

		$content['view_file'] = 'admin.auth.' . $page;

		$content['page_title'] = $page_title;

		$content['controller_data'] = $data;

		echo view('layout.guest', $content);

		return;
	}
}
