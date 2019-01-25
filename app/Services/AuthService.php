<?php
declare( strict_types = 1 );

namespace App\Services;

use App\Models\User;
use Auth;

/**
 * Class AuthService
 * @package App\Services
 */
class AuthService
{
	/**
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard () : \Illuminate\Contracts\Auth\StatefulGuard
	{
		return Auth::guard();
	}

	/**
	 * Login user
	 *
	 * @param User $user
	 */
	public function login (User $user) : void
	{
		$this->guard()
		     ->login($user);
	}
}