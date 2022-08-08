<?php

namespace App\Providers;

use App\Http\View\Composers\AdminNotificationComposer;
use App\Http\View\Composers\StudentNotificationComposer;
use App\Http\View\Composers\TeacherNotificationComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        // database
        Schema::defaultStringLength(191);
        
        // pagination
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-4');

        // Notification
        View::composer(['admin.layout.app'], AdminNotificationComposer::class);
        View::composer(['student.layout.*'], StudentNotificationComposer::class);
        View::composer(['teacher.layout.app'], TeacherNotificationComposer::class);
    }
}
