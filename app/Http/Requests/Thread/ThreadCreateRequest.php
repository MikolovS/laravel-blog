<?php
declare( strict_types = 1 );

namespace App\Http\Requests\Thread;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ThreadCreateRequest
 * @package App\Http\Requests\Thread
 */
class ThreadCreateRequest extends FormRequest
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
			'title'   => [
				'required',
				'string',
				'min:3',
				'unique:threads',
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
