<?php

namespace App\Providers;


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
        \App\Events\MovimientoCreado::class => [
            \App\Listeners\ActualizarSaldosMovimientoCreado::class,
        ],
        \App\Events\MovimientoEliminado::class => [
            \App\Listeners\ActualizarSaldosMovimientoEliminado::class,
        ],
        //facturacion
        \App\Events\FacturaCreada::class => [
            \App\Listeners\ActualizarMovimientosFactura::class
        ],
        \App\Events\FacturaEliminada::class => [
            \App\Listeners\RevertirMovimientosFactura::class
        ],
        //liquidacion
        \App\Events\LiquidacionCreada::class => [
            \App\Listeners\GuardarMovimientosListener::class,
            \App\Listeners\GuardarAnticiposListener::class,
            \App\Listeners\GuardarGastosListener::class,
        ],
        \App\Events\LiquidacionEliminada::class => [
            \App\Listeners\EliminarMovimientosListener::class,
            \App\Listeners\EliminarAnticiposListener::class,
            \App\Listeners\EliminarGastosListener::class,
        ],
        // Recibo
        \App\Events\ReciboCreado::class => [
            \App\Listeners\GuardarPagosRecibo::class,
            \App\Listeners\GuardarFacturasRecibo::class,
            \App\Listeners\ActualizarSaldoClienteRecibo::class,
            \App\Listeners\ActualizarSaldoFacturasRecibo::class,
        ],
        \App\Events\ReciboEliminado::class => [
            \App\Listeners\RevertirSaldoClienteRecibo::class,
            \App\Listeners\RevertirSaldoFacturasRecibo::class,
            \App\Listeners\EliminarPagosRecibo::class,
            \App\Listeners\EliminarFacturasRecibo::class,
        ],
        // gasto
        \App\Events\GastoCreado::class => [
            \App\Listeners\ActualizarSaldoChoferPorGastoCreado::class,
        ],
        \App\Events\GastoEliminado::class => [
            \App\Listeners\ActualizarSaldoChoferPorGastoEliminado::class,
        ],
        // anticipo
        \App\Events\AnticipoCreado::class => [
            \App\Listeners\ActualizarSaldoChoferPorAnticipoCreado::class,
        ],
        \App\Events\AnticipoEliminado::class => [
            \App\Listeners\ActualizarSaldoChoferPorAnticipoEliminado::class,
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
