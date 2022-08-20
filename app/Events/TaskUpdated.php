<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $list;
    public $task;
    public $complete;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($list, $task, $complete)
    {
        $this->list = $list;
        $this->task = $task;
        $this->complete = $complete;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        Log::debug("TaskUpdated: {$this->list}, Task: {$this->task}, Complete? : {$this->complete}");
        return new PrivateChannel("list.{$this->list}");
    }
}
