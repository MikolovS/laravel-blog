<?php
declare( strict_types = 1 );

namespace App\Services;

use App\Models\Reply;

/**
 * Class ReplyService
 * @package App\Services
 */
class ReplyService
{
	/**
	 * @var Reply
	 */
	private $repository;

	/**
	 * ThreadService constructor.
	 * @param Reply $reply
	 */
	public function __construct (Reply $reply)
	{
		$this->repository = $reply;
	}

	/**
	 * @param array $data
	 * @return Reply
	 * @throws \Exception
	 */
	public function create (array $data) : Reply
	{
		return $this->repository::create($data);
	}
}