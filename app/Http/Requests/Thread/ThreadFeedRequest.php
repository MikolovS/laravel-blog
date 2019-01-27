<?php
declare( strict_types = 1 );

namespace App\Http\Requests\Thread;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ThreadCreateRequest
 * @package App\Http\Requests\Thread
 * @property-read array  $authors
 * @property-read string $order
 */
class ThreadFeedRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize () : bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules () : array
	{
		return [
			'authors'   => 'array',
			'authors.*' => 'int|min:1|exists:users,id',
			'order'     => 'string|in:ASC,DESC',
		];
	}
}
