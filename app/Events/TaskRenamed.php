<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskRenamed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $list;
    public $task;
    public $title;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($list, $task, $title)
    {
        $this->list = $list;
        $this->task = $task;
        $this->title = $title;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        Log::debug("TaskRenamed: {$this->list}, Task: {$this->task}, Title: {$this->title}");
        return new PrivateChannel("list.{$this->list}");
    }
}
