<?php

namespace App\Http\Livewire;

use App\Events\NotificationEvent;
use Livewire\Component;

class NotificationToast extends Component
{
    public $room_id;
    private $notification_message = null;

    public function getListeners()
    {
        return [
            "echo:room.{$this->room_id},.join-room" => 'joinNotification',
            "echo:room.{$this->room_id},.leave-room" => 'leaveNotification',
        ];
    }

    public function joinNotification()
    {
        $segment = explode('/', request()->header('referer'))[6] ?? 0;
        if (auth()->user()->current_room_id == $this->room_id &&
            $segment != $this->room_id) {
            $this->notification_message = 'User joined your room!';
            broadcast(new NotificationEvent($this->room_id));
            $this->render();
        }
    }

    public function leaveNotification()
    {
        $segment = explode('/', request()->header('referer'))[6] ?? 0;
        if (auth()->user()->current_room_id == $this->room_id &&
            $segment != $this->room_id) {
            $this->notification_message = 'User left your room!';
            broadcast(new NotificationEvent($this->room_id));
            $this->render();
        }
    }

    public function render()
    {
        return view('livewire.notification-toast', [
            'notification_message' => $this->notification_message,
            'room_id' => $this->room_id
        ]);
    }
}
