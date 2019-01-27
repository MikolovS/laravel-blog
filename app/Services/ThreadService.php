<?php
declare( strict_types = 1 );

namespace App\Services;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Class ThreadService
 * @package App\Services
 */
class ThreadService
{
	/**
	 * @var Thread
	 */
	private $repository;

	/**
	 * ThreadService constructor.
	 * @param Thread $thread
	 */
	public function __construct (Thread $thread)
	{
		$this->repository = $thread;
	}

	/**
	 * @param array $data
	 * @return Thread|\Illuminate\Database\Eloquent\Model
	 * @throws \Exception
	 */
	public function create (array $data)
	{
		return $this->repository::create($data);
	}

	/**
	 * @param Thread $thread
	 * @param array  $data
	 * @return Thread
	 */
	public function update (Thread $thread, array $data) : Thread
	{
		$thread->update($data);
		$thread->refresh();

		return $thread;
	}

	/**
	 * @param Thread $thread
	 * @return bool|null
	 * @throws \Exception
	 */
	public function delete (Thread $thread) : ?bool
	{
		return $thread->delete();
	}

	/**
	 * @param int $userId
	 * @return Collection
	 */
	public function getUserThreads (int $userId) : Collection
	{
		return $this->repository::whereUserId($userId)
		                        ->orderByDesc('created_at')
		                        ->get();
	}

	/**
	 * @param array $options
	 * @return Thread[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getFeed (array $options)
	{
		$query = $this->repository::with('creator');

		if (isset($options[ 'authors' ]))
			$query->whereIn('user_id', $options[ 'authors' ]);

		if (isset($options[ 'order' ]))
			$query->orderBy('created_at', $options[ 'order' ]);
		else
			$query->orderByDesc('created_at');

		return $query->get();
	}

	/**
	 * @param array $checkedAuthors
	 * @return User[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
	 */
	public function getUsersWithThreads (array $checkedAuthors)
	{
		$authors = User::whereHas('threads')
		               ->get();

		return $authors->map(function (User $author) use ($checkedAuthors) {
			$author->checked = in_array($author->id, $checkedAuthors);

			return $author;
		});
	}
}