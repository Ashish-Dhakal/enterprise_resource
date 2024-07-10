<?php

namespace App\Providers;

use App\Models\Notice;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;


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
    public function boot(Dispatcher $events): void
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->addAfter(
                'Timesheet',
                [
                    'text' => 'Notice',
                    'route' => 'notice.index',
                    'icon' => 'far fa-bell',
                    'label'=> Notice::where('user_id', auth()->user()->id)->whereNull('read_at')->count(),
                    'label_color' => 'success',
                ],
            );
        });
        Paginator::useBootstrap();
        // Paginator::useBootstrapFive();

        Validator::extend('time_format', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/', $value);
        });
    }
}
