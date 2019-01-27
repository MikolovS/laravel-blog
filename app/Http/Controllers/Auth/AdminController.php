<?php
declare( strict_types = 1 );

namespace App\Http\Controllers\Auth;

use App\Models\Thread;
use App\Services\ThreadService;
use App\Http\Controllers\Controller;

/**
 * Class AdminController
 * @package App\Http\Controllers\Auth
 */
class AdminController extends Controller
{
	/**
	 * @var ThreadService
	 */
	private $threadsService;

	/**
	 * Create a new controller instance.
	 *
	 * @param ThreadService $threadsService
	 */
	public function __construct (ThreadService $threadsService)
	{
		$this->middleware('auth:admin');
		$this->threadsService = $threadsService;
	}

	/**
	 * show dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index ()
	{
		return view('thread.admin_threads')->with(['threads' => $this->threadsService->getFeed([])]);
	}

	public function deleteThread (Thread $thread)
	{
		$this->threadsService->delete($thread);

		return view('thread.admin_threads')->with([
			'message' => 'Thread deleted',
			'threads' => $this->threadsService->getFeed([]),
		]);
	}
}
