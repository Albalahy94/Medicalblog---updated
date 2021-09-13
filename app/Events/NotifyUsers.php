<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class NotifyUsers
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user_id;
    public $user_name;
    public $user_comment;
    public $time;
    public $date;

    public function __construct($data = [])
    {
        $this->user_id = $data['user_id'];
        $this->user_name = $data['post_id'];
        $this->user_comment = $data['content'];
        $this->time = date('Y : M : d', strtotime(Carbon::now()));
        $this->date = date('h:i A', strtotime(Carbon::now()));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['new-notification'];
        // return new Channel('notify-users');
    }
    // public function broadcastAs()
    // {
    //     return 'my-event';
    // }
}