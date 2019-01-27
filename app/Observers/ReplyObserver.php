<?php
declare( strict_types = 1 );

namespace App\Observers;

use App\Models\Reply;
use App\Services\MailService;

/**
 * Class ThreadObserver
 * @package App\Observers
 */
class ReplyObserver
{
	/**
	 * @var MailService
	 */
	private $mailService;

	/**
	 * ThreadObserver constructor.
	 * @param MailService $mailService
	 */
	public function __construct (MailService $mailService)
	{
		$this->mailService = $mailService;
	}

	/**
	 * Listen to the Reply created event.
	 *
	 * @param Reply $reply
	 * @return void
	 * @throws \Exception
	 */
	public function created (Reply $reply) : void
	{
		$this->mailService->send($reply->thread->creator->email, $reply->creator->email, $reply->content);
	}
}