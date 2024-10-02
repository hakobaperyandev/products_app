<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithBroadcasting;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductUpdatedEvent implements ShouldBroadcastNow
{
    use InteractsWithBroadcasting;

    public $product;

    /**
     * Create a new event instance.
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('product-updated'), // Broadcast on the 'products' channel
        ];
    }

    /**
     * Get the data that should be broadcast with the event.
     *
     * @return array
     */
    public function broadcastWith(): array
    {
        return [
            'id'       => $this->product->id,
            'title'    => $this->product->title,
            'price'    => $this->product->price,
            'quantity' => $this->product->quantity,
        ];
    }
}
