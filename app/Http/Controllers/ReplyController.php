<?php
declare( strict_types = 1 );

namespace App\Http\Controllers;

use App\Http\Requests\Reply\ReplyCreateRequest;
use App\Models\User;
use App\Services\ReplyService;

/**
 * Class ReplyController
 * @package App\Http\Controllers
 */
class ReplyController extends Controller
{
	/**
	 * @var ReplyService
	 */
	private $replyService;

	/**
	 * ThreadController constructor.
	 * @param ReplyService $replyService
	 */
	public function __construct (ReplyService $replyService)
	{
		$this->replyService = $replyService;
	}

	/**
	 * @param ReplyCreateRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function create (ReplyCreateRequest $request)
	{
		/** @var User $user */
		$user = \Auth::user();

		$replyData              = $request->validated();
		$replyData[ 'user_id' ] = $user->id;

		$thread = $this->replyService->create($replyData)->thread;

		return redirect(route('thread_with_replies', [$thread->id]))->with(['message' => 'Reply send']);
	}
}