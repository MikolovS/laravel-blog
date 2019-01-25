<?php
declare( strict_types = 1 );

namespace App\Http\Controllers\Auth;

use App\Http\Requests\User\UserCreateRequest;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\View\View;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
	use RedirectsUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/profile';

	/**
	 * @var UserService
	 */
	private $userService;

	/**
	 * @var AuthService
	 */
	private $authService;

	/**
	 * Create a new controller instance.
	 *
	 * @param UserService $userService
	 * @param AuthService $authService
	 */
	public function __construct (UserService $userService, AuthService $authService)
	{
		$this->middleware('guest');
		$this->userService = $userService;
		$this->authService = $authService;
	}

	/**
	 * Show the application registration form.
	 *
	 * @return View
	 */
	public function showRegistrationForm () : View
	{
		return view('auth.register');
	}

	/**
	 * Handle register request
	 *
	 * @param UserCreateRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function register (UserCreateRequest $request)
	{
		$user = $this->userService->create($request->validated());

		event(new Registered($user));

		$this->authService->login($user);

		return redirect($this->redirectPath());
	}
}
