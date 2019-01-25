<?php
declare( strict_types = 1 );

namespace App\Services;

use App\Models\Thread;

/**
 * Class ThreadCountControlService
 * @package App\Services
 */
class ThreadCountControlService
{
	/**
	 * @var Thread
	 */
	private $repository;

	/**
	 * ThreadCountControlService constructor.
	 * @param Thread $repository
	 */
	public function __construct (Thread $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @param int $userId
	 * @throws \Exception
	 */
	public function deleteOldUserThreads (int $userId) : void
	{
		$threads = $this->repository::whereUserId($userId)
		                            ->orderByDesc('created_at')
		                            ->skip($this->getSkip())
		                            ->get();

		if ($threads->isNotEmpty())
			$this->repository::whereIn('id', $threads->pluck('id')
			                                         ->toArray())
			                 ->delete();
	}

	/**
	 * @return int
	 */
	protected function getSkip () : int
	{
		return 4;
	}
}