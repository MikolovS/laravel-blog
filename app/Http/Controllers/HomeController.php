<?php
declare( strict_types = 1 );

namespace App\Http\Controllers;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
	/**
	 * @return View
	 */
	public function profile() : View
    {
        return view('profile');
    }

	/**
	 * @return View
	 */
	public function index() : View
	{
		return view('home');
	}
}
