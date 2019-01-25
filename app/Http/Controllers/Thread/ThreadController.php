<?php
declare( strict_types = 1 );

namespace App\Http\Controllers\Thread;

use App\Http\Controllers\Controller;
use App\Http\Requests\Thread\ThreadCreateRequest;
use App\Http\Requests\Thread\ThreadUpdateRequest;
use App\Models\Thread;
use App\Models\User;
use App\Services\ThreadService;
use Illuminate\View\View;

/**
 * Class ThreadController
 * @package App\Http\Controllers\Thread
 */
class ThreadController extends Controller
{
	/**
	 * @var ThreadService
	 */
	private $threadService;

	/**
	 * ThreadController constructor.
	 * @param ThreadService $threadService
	 */
	public function __construct (ThreadService $threadService)
	{
		$this->threadService = $threadService;
	}

	/**
	 * @param ThreadCreateRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Exception
	 */
	public function create (ThreadCreateRequest $request)
	{
		/** @var User $user */
		$user = \Auth::user();

		$threadData              = $request->validated();
		$threadData[ 'user_id' ] = $user->id;

		$this->threadService->create($threadData);

		$threads = $this->threadService->getUserThreads($user->id);

		return view('profile')->with([
			'threads' => $threads,
			'message' => 'Thread created',
		]);
	}

	/**
	 * @param Thread              $thread
	 * @param ThreadUpdateRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update (Thread $thread, ThreadUpdateRequest $request)
	{
		/** @noinspection PhpParamsInspection */
		$thread = $this->threadService->update($thread, $request->validated());

		return view('thread.thread')->with([
			'thread'  => $thread,
			'message' => 'Thread updated',
		]);
	}

	/**
	 * @return View
	 */
	public function getForm () : View
	{
		return view('thread.thread');
	}

	/**
	 * @param Thread $thread
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function get (Thread $thread)
	{
		return view('thread.thread')->with(['thread' => $thread]);
	}

	/**
	 * @return View
	 */
	public function getUserThreads () : View
	{
		$threads = $this->threadService->getUserThreads(\Auth::user()->id);

		return view('profile')->with(['threads' => $threads]);
	}

	/**
	 * @param Thread $thread
	 * @return View
	 * @throws \Exception
	 */
	public function delete (Thread $thread) : View
	{
		$this->threadService->delete($thread);

		return view('profile')->with(['threads' => $this->threadService->getUserThreads(\Auth::user()->id), 'message' => 'Thread deleted']);
	}
}