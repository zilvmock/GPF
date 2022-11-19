<div class="flex items-center">
    @if(auth()->user()->id == $owner_id)
        <form action="{{route('delete_room', ['room' => $room_id, 'game' => $game_slug, 'id' => $game_id])}}" method="post">
            @csrf
            @method('DELETE')
            <x-button variant="danger" size="sm">
                <x-heroicon-o-trash class="w-4"/>
                Delete Room
            </x-button>
        </form>
        @livewire('lock-button', [
            'room_id' => $room_id,
            'room_lock' => $room_lock,
        ])
    @else
        <form action="{{route('leave_room', ['room' => $room_id, 'game' => $game_slug, 'id' => $game_id])}}" method="post">
            @csrf
            @method('PUT')
            <x-button variant="primary" size="sm"><b>Leave Room</b></x-button>
        </form>
    @endif
</div>
