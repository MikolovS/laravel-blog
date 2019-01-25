<?php
declare( strict_types = 1 );

namespace App\Services;

use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
	/**
	 * @var User
	 */
	private $repository;

	/**
	 * UserService constructor.
	 * @param User $repository
	 */
	public function __construct (User $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @param array $data
	 * @return User
	 */
	public function create (array $data) : User
	{
		return $this->repository::create($data);
	}
}