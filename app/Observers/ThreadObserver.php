<?php
declare( strict_types = 1 );

namespace App\Observers;

use App\Models\Thread;
use App\Services\ThreadCountControlService;

/**
 * Class ThreadObserver
 * @package App\Observers
 */
class ThreadObserver
{
	/**
	 * @var ThreadCountControlService
	 */
	private $threadCountControlService;

	/**
	 * ThreadObserver constructor.
	 * @param ThreadCountControlService $threadCountControlService
	 */
	public function __construct (ThreadCountControlService $threadCountControlService)
	{
		$this->threadCountControlService = $threadCountControlService;
	}

	/**
	 * Listen to the Thread creating event.
	 *
	 * @param Thread $thread
	 * @return void
	 * @throws \Exception
	 */
	public function creating (Thread $thread) : void
	{
		$this->threadCountControlService->deleteOldUserThreads($thread->user_id);
	}
}