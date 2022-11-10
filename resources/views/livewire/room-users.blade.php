<div>
    <h5 class=""><b>Users</b> <small>({{$users->count()}}/{{$room_size}})</small></h5>
    @foreach($users as $user)
        @if($user->id == $owner_id)
            <div class="flex items-center justify-between">
                <h1 class="mr-1">{{$user->username}}</h1>
                <x-heroicon-s-star class="w-5 text-yellow-300" data-tooltip-target="tooltip-default"/>
                <x-tooltip>Room Owner</x-tooltip>
            </div>
        @else
            <div class="flex items-center justify-between">
                <h1 class="mr-1">{{$user->username}}</h1>
                @if(auth()->user()->id == $owner_id)
                    <x-button iconOnly variant="secondary" size="xs" id="kick-usr-{{$user->id}}"
                              data-modal-toggle="popup-modal-{{$user->id}}">
                        <x-heroicon-o-x class="w-4 text-red-500"/>
                    </x-button>
                @endif
            </div>
            @if(auth()->user()->id == $owner_id)
                <form action="{{route('kick_from_room', ['room' => $room_id, 'user' => $user->id])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div id="popup-modal-{{$user->id}}" tabindex="-1"
                         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <div class="p-6 text-center">
                                    <x-heroicon-o-exclamation-circle
                                        class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200"/>
                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                        Do you want to kick this user from the room?
                                    </h3>
                                    <button data-modal-toggle="popup-modal-{{$user->id}}" type="submit"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none
                                            focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm
                                            inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Yes, bye bye!
                                    </button>
                                    <button data-modal-toggle="popup-modal-{{$user->id}}" type="button"
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
            @endif
        @endif
    @endforeach
</div>
