<div class="">
    @foreach($rooms as $room)
        <div id="room-{{$room->id}}"
             class="flex p-2 my-2 items-center content-center justify-between max-w-full bg-white rounded-lg border border-gray-200 shadow-md
         {{auth()->user()->current_room_id == $room->id ? "bg-gradient-to-br from-purple-500/50 dark:bg-gray-800" : "dark:bg-gray-800"}} dark:border-gray-700">
            <div class="flex items-center">
            <span
                class="flex flex-col justify-items-center items-center w-10 mr-4 {{$room->users_count >= $room->size ? "bg-gradient-to-br from-red-500/50 dark:bg-gray-800" : "bg-gray-100"}} text-gray-800 text-xs font-semibold px-2 py-1 rounded dark:bg-gray-700 dark:text-gray-300">
                <x-heroicon-o-user-group class="w-5"/>
                <small class="text-center">
                    {{$room->users_count}} / {{$room->size}}
                </small>
            </span>
                <h1 id="room-{{$room->id}}-title"
                    class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{$room->title}}</h1>
            </div>
            <div class="flex items-center">
                @if ($room->users_count >= $room->size)
                    <x-button data-tooltip-target="tooltip-default" variant="primary" size="sm" disabled>
                        <x-heroicon-o-arrow-left-on-rectangle class="w-5"/>
                        Join Room
                    </x-button>
                    <x-tooltip>Full</x-tooltip>
                @else
                    <form action="{{route('join_room', ['room' => $room->id, 'game' => $game_slug, 'id' => $game_id])}}"
                          method="post">
                        @csrf
                        @method('GET')
                        <x-button variant="primary" size="sm">
                            <x-heroicon-o-arrow-left-on-rectangle class="w-5"/>
                            Join Room
                        </x-button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
