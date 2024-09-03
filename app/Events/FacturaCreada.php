<?php

namespace App\Events;

use App\Models\ClienteFactura;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FacturaCreada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $factura;
    public $movimientos;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ClienteFactura $factura, array $movimientos)
    {
        $this->factura = $factura;
        $this->movimientos = $movimientos;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
