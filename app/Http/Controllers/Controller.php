<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Render views with public layout
     *
     * @param string $page View file path not including 'admin/'
     * @param string $page_title Page title
     * @param array $controller_data Passed data
     * @return void
     */
    public function publicTemplate($page, $page_title, $data = [])
    {
        // prep.  data
        
        $content['view_file'] = $page;

        $content['page_title'] = $page_title;

        $content['controller_data'] = $data;

        echo view('layout.app', $content);

        return;
    }
    /**
	 * Render views with admin Auth layout
	 *
	 * @param string $page View file path not including 'admin/auth'
	 * @param string $page_title Page title
	 * @param array $controller_data Passed data
	 * @return void
	 */
	public function publicAuthTemplate($page, $page_title, $data = [])
	{
		// prep.  data
		$content['view_file'] =  $page;

		$content['page_title'] = $page_title;

		$content['controller_data'] = $data;

		echo view('layout.guest', $content);

		return;
	}
}
