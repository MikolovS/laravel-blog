<?php
declare( strict_types = 1 );

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Thread
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $creator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Thread whereUserId($value)
 * @mixin \Eloquent
 */
class Thread extends Model
{
	/**
	 * @var array
	 */
	public $fillable = [
		'user_id',
		'title',
		'content',
	];

	/**
	 * @return BelongsTo
	 */
	public function creator() : BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}