<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Auth\Access\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);
            $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
                $event->menu->add([
                    'text' => 'Andamento da mineração',
                    'url' => 'cliente/' . Auth::user()->cliente_id . '',
                    'icon' => 'user',
                    'icon_color' => 'gold-color',
                    'can' => 'user'
                ]);
            });
    }

    public function register()
    {
        //
    }
}
