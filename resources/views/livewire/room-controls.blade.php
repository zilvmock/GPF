<div class="flex-col items-center space-y-1">
    @if(auth()->user()->id == $owner_id)
        @livewire('lock-button', [
           'room_id' => $room_id,
           'room_lock' => $room_lock,
       ])
        <form action="{{route('delete_room', ['room' => $room_id, 'game' => $game_slug, 'id' => $game_id])}}"
              method="post">
            @csrf
            @method('DELETE')
            <x-button variant="danger" size="sm" class="w-full flex justify-center">
                <x-heroicon-o-trash class="w-4"/>
                {{__('Delete Room')}}
            </x-button>
        </form>
    @else
        <form action="{{route('leave_room', ['room' => $room_id, 'game' => $game_slug, 'id' => $game_id])}}"
              method="post">
            @csrf
            @method('PUT')
            <x-button class="w-full flex justify-center" variant="primary" size="sm">{{__('Leave Room')}}</x-button>
        </form>
    @endif
</div>
