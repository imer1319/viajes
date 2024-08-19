<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LiquidacionCreada
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $chofer_id;
    public $liquidacion_id;
    public $movimientos;
    public $anticipos;
    public $gastos;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($chofer_id, $liquidacion_id, $movimientos, $anticipos, $gastos)
    {
        $this->chofer_id = $chofer_id;
        $this->liquidacion_id = $liquidacion_id;
        $this->movimientos = $movimientos;
        $this->anticipos = $anticipos;
        $this->gastos = $gastos;
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
