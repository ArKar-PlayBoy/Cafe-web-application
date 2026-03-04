<?php

namespace App\Providers;

<<<<<<< HEAD
=======
use App\Events\OrderCreated;
use App\Events\OrderStatusChanged;
use App\Listeners\SendOrderConfirmation;
use App\Listeners\SendOrderStatusUpdate;
use Illuminate\Support\Facades\Event;
>>>>>>> 5b466fb (more reliable and front-end changes)
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        //
=======
        Event::listen(
            OrderCreated::class,
            SendOrderConfirmation::class
        );

        Event::listen(
            OrderStatusChanged::class,
            SendOrderStatusUpdate::class
        );
>>>>>>> 5b466fb (more reliable and front-end changes)
    }
}
