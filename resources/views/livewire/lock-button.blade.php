<div class="ml-2">
    <form action="{{route('lock_room', ['room' => $room_id])}}" method="post">
        @csrf
        @method('PUT')
        @if($room_lock)
            <x-button variant="primary" size="sm">
                <x-heroicon-o-lock-closed class="w-4"/>
                Unlock Room
            </x-button>
        @else
            <x-button variant="primary" size="sm">
                <x-heroicon-o-lock-open class="w-4"/>
                Lock Room
            </x-button>
        @endif
    </form>
</div>
