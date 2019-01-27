<?php
declare( strict_types = 1 );

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Replay
 *
 * @property int                             $id
 * @property int                             $thread_id
 * @property int                             $user_id
 * @property string|null                     $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User           $creator
 * @property-read \App\Models\Thread         $thread
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereContent( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereThreadId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Reply whereUserId( $value )
 * @mixin \Eloquent
 */
class Reply extends Model
{
	public $table = 'replies';

	public $fillable = [
		'user_id',
		'thread_id',
		'content',
	];

	/**
	 * @return BelongsTo
	 */
	public function thread () : BelongsTo
	{
		return $this->belongsTo(Thread::class, 'thread_id');
	}

	/**
	 * @return BelongsTo
	 */
	public function creator () : BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}