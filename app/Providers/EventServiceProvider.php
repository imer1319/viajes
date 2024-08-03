<?php

namespace App\Providers;

use App\Events\MovimientoCreado;
use App\Events\MovimientoEliminado;
use App\Listeners\ActualizarSaldosMovimientoCreado;
use App\Listeners\ActualizarSaldosMovimientoEliminado;
use App\Listeners\EnviarNotificacionMovimientoCreado;
use App\Listeners\EnviarNotificacionMovimientoEliminado;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MovimientoCreado::class => [
            ActualizarSaldosMovimientoCreado::class,
        ],
        MovimientoEliminado::class => [
            ActualizarSaldosMovimientoEliminado::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
