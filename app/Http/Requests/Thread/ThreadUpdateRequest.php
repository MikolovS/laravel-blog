<?php
declare( strict_types = 1 );

namespace App\Http\Requests\Thread;

use App\Models\Thread;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ThreadUpdateRequest
 * @package App\Http\Requests\Thread
 */
class ThreadUpdateRequest extends FormRequest
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
		/** @var Thread $thread */
		$thread = $this->route('thread');

		return [
			'title'   => [
				'required',
				'string',
				'min:3',
				'unique:threads,title,' . $thread->id,
				'regex:/^[A-Za-z\s-_]+$/s',
			],
			'content' => [
				'nullable',
				'string',
				'max:255',
				'regex:/^.+\.$/s',
			],
		];
	}
}
