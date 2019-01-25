<?php
declare( strict_types = 1 );

namespace App\Providers;

use App\Models\Thread;
use App\Observers\ThreadObserver;
use Illuminate\Support\ServiceProvider;

/**
 * Class ObserverServiceProvider
 * @package App\Providers
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot() : void
    {
        Thread::observe(ThreadObserver::class);
    }
}
