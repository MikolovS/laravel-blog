<?php
declare( strict_types = 1 );

namespace App\Http\Requests\Reply;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ReplayCreateRequest
 * @package App\Http\Requests\Reply
 */
class ReplyCreateRequest extends FormRequest
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
			'thread_id' => 'required|int|min:1|exists:threads,id',
			'content'   => 'required|string|max:255',
		];
	}
}
