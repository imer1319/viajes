<?php

namespace App\Events;

use App\Models\Recibo;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReciboCreado
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $recibo;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(Recibo $recibo)
    {
        $this->recibo = $recibo;
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
