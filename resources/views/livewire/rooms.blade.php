<div class="">
    @foreach($rooms as $room)
        <div id="room-{{$room->id}}"
             class="flex p-2 my-2 items-center content-center justify-between max-w-full bg-white rounded-lg border border-gray-200 shadow-md
             {{auth()->user()->current_room_id == $room->id ? "bg-gradient-to-br from-purple-500/50 dark:bg-gray-800" : "dark:bg-gray-800"}}
             dark:border-gray-700">
            <div class="flex items-center">
                <span class="flex flex-col justify-items-center items-center w-12 mr-4
                     {{$room->users_count >= $room->size ? "bg-gradient-to-br from-red-500/50 dark:bg-gray-800" : "bg-gray-100"}}
                      text-gray-800 text-xs font-semibold px-2 py-1 rounded dark:bg-gray-700 dark:text-gray-300">
                    <x-heroicon-o-user-group class="w-5"/>
                    <small class="text-center">
                        {{$room->users_count}} / {{$room->size}}
                    </small>
                </span>
                <h1 id="room-{{$room->id}}-title"
                    class="w-11/12 mr-4 md:text-lg text-sm font-bold break-all tracking-tight text-gray-900 dark:text-white">
                    {{$room->title}}
                </h1>
            </div>
            <div class="flex items-center">
                @if ($room->users_count >= $room->size && auth()->user()->current_room_id != $room->id)
                    <x-button data-tooltip-target="tooltip-default" variant="primary" size="sm" disabled>
                        <x-heroicon-o-arrow-left-on-rectangle class="w-5"/>
                        Join
                    </x-button>
                    <x-tooltip>Full</x-tooltip>
                @elseif($room->is_locked && auth()->user()->current_room_id != $room->id)
                    <x-button data-tooltip-target="tooltip-default" variant="primary" size="sm" disabled>
                        <x-heroicon-s-lock-closed class="w-5 text-red-400"/>
                        Join
                    </x-button>
                    <x-tooltip>Locked</x-tooltip>
                @elseif (auth()->user()->current_room_id != 0 && auth()->user()->current_room_id != $room->id)
                    <x-button variant="primary" size="sm" type="none" data-modal-toggle="popup-modal-{{$room->id}}">
                        <x-heroicon-o-arrow-left-on-rectangle class="w-5"/>
                        Join
                    </x-button>
                    <form action="{{route('join_room', ['room' => $room->id, 'game' => $game_slug, 'id' => $game_id])}}"
                          method="post">
                        @csrf
                        @method('GET')
                        <div id="popup-modal-{{$room->id}}" tabindex="-1"
                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="p-6 text-center">
                                        <x-heroicon-o-exclamation-circle
                                            class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"/>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                            You haven't left your last room! Do you want to leave and join this room
                                            instead? If you are the owner of previous room, new owner will be picked.
                                            Otherwise, if room is empty it will be deleted.
                                        </h3>
                                        <button type="submit" data-modal-toggle="popup-modal-{{$room->id}}"
                                                class="text-white bg-red-600
                                                hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300
                                                dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex
                                                items-center px-5 py-2.5 text-center mr-2">
                                            Yes, join this room
                                        </button>
                                        <button data-modal-toggle="popup-modal-{{$room->id}}" type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none
                                                focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5
                                                py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300
                                                dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600
                                                dark:focus:ring-gray-600">
                                            No, cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{route('join_room', ['room' => $room->id, 'game' => $game_slug, 'id' => $game_id])}}"
                          method="post">
                        @csrf
                        @method('GET')
                        <x-button variant="primary" size="sm">
                            <x-heroicon-o-arrow-left-on-rectangle class="w-5"/>
                            Join
                        </x-button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
    @if($rooms->hasPages())
        <div>
            {{ $rooms->links()}}
        </div>
    @endif
</div>
