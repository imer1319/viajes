<?php

namespace App\Events;

use App\Models\Movimiento;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MovimientoEliminado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $movimiento;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Movimiento $movimiento)
    {
        $this->movimiento = $movimiento;
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
