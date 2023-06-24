<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {
            $notifications = Notification::getLatestNotifications();
            $totalUnSeenNotifications = collect(Notification::getUnSeenNotifications())->count();

            $view->with('notifications', $notifications);
            $view->with('totalUnSeenNotifications', $totalUnSeenNotifications);
        });


    }
}
