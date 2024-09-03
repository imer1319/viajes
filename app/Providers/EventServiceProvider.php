<?php

namespace App\Providers;

use App\Events\AnticipoCreado;
use App\Events\AnticipoEliminado;
use App\Events\GastoCreado;
use App\Events\GastoEliminado;
use App\Events\LiquidacionCreada;
use App\Events\LiquidacionEliminada;
use App\Events\MovimientoCreado;
use App\Events\MovimientoEliminado;
use App\Listeners\ActualizarSaldoChoferPorAnticipoCreado;
use App\Listeners\ActualizarSaldoChoferPorAnticipoEliminado;
use App\Listeners\ActualizarSaldoChoferPorGastoCreado;
use App\Listeners\ActualizarSaldoChoferPorGastoEliminado;
use App\Listeners\ActualizarSaldosMovimientoCreado;
use App\Listeners\ActualizarSaldosMovimientoEliminado;
use App\Listeners\EliminarAnticiposListener;
use App\Listeners\EliminarGastosListener;
use App\Listeners\EliminarMovimientosListener;
use App\Listeners\GuardarAnticiposListener;
use App\Listeners\GuardarGastosListener;
use App\Listeners\GuardarMovimientosListener;
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
        //liquidacion
        LiquidacionCreada::class => [
            GuardarMovimientosListener::class,
            GuardarAnticiposListener::class,
            GuardarGastosListener::class,
        ],
        LiquidacionEliminada::class => [
            EliminarMovimientosListener::class,
            EliminarAnticiposListener::class,
            EliminarGastosListener::class,
        ],
        // gasto
        GastoCreado::class => [
            ActualizarSaldoChoferPorGastoCreado::class,
        ],
        GastoEliminado::class => [
            ActualizarSaldoChoferPorGastoEliminado::class,
        ],
        // anticipo
        AnticipoCreado::class => [
            ActualizarSaldoChoferPorAnticipoCreado::class,
        ],
        AnticipoEliminado::class => [
            ActualizarSaldoChoferPorAnticipoEliminado::class,
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
