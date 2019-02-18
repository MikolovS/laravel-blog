<?php
declare( strict_types = 1 );

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Admin
 *
 * @property int
 *               $id
 * @property string
 *               $email
 * @property string
 *               $password
 * @property string|null
 *               $remember_token
 * @property \Illuminate\Support\Carbon|null
 *               $created_at
 * @property \Illuminate\Support\Carbon|null
 *               $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[]
 *                $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereRememberToken( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt( $value )
 * @mixin \Eloquent
 */
class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    public $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
