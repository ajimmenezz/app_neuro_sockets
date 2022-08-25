<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Questions as MQuestions;
use App\Models\EventUsers;

class NewQuestion implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $question;
    public $userId;
    public $name;
    public $id;
    public $date;
    public $date_order;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $userId, string $question)
    {
        $this->userId = $userId;
        $this->question = $question;
        $this->name = EventUsers::getUserName($userId);
        $reg = $this->saveToDB();
        $this->id = $reg->id;
        $d = new \DateTime($reg->created_at);
        $this->date = $d->format('d/m/Y H:i:s');
        $this->date_order = $d->format('YmdHis');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('questions');
    }

    private function saveToDB()
    {
        return MQuestions::updateOrCreate([
            'UserId' => $this->userId,
            'Question' => $this->question,
            'Readed' => false
        ]);
    }
}
