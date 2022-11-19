<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __($room_title) }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card>
        @livewire('room-controls', [
            'room_id' => $room,
            'game_slug' => $game,
            'game_id' => $id,
            'room_title' => $room_title,
            'room_lock' => $room_lock,
        ])
        <div class="md:flex my-4 md:space-x-2 space-y-2">
            <x-layout.layout-card-2 class="h-max mt-2">
                @livewire('room-users', ['room_id' => $room, 'room_size' => $room_size])
            </x-layout.layout-card-2>
            <x-layout.layout-card-2 class="md:w-screen">
                <div class="h-96 overflow-y-auto" style="display: flex; flex-direction: column-reverse;">
                    @livewire('chat', [
                        'room_id' => $room,
                    ])
                </div>
                <div>
                    <form action="{{route('send_message', ['room' => $room])}}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="chat" class="sr-only">Your message</label>
                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                            {{--                            <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">--}}
                            {{--                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>--}}
                            {{--                                <span class="sr-only">Upload image</span>--}}
                            {{--                            </button>--}}
                            {{--                            <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">--}}
                            {{--                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg>--}}
                            {{--                                <span class="sr-only">Add emoji</span>--}}
                            {{--                            </button>--}}
                            <!--suppress HtmlFormInputWithoutLabel -->
                            <input type="text" name="message" id="msg"
                                   class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                                   placeholder="Your message..."/>
                            <button type="submit"
                                    class="inline-flex justify-center p-2 text-purple-600 rounded-full cursor-pointer hover:bg-purple-100 dark:text-purple-500 dark:hover:bg-gray-600">
                                <x-heroicon-s-paper-airplane class="w-6 h-6 rotate-90"/>
                                <span class="sr-only">Send message</span>
                            </button>
                        </div>
                    </form>
                </div>
            </x-layout.layout-card-2>
        </div>
    </x-layout.layout-card>
</x-app-layout>
<script>
    window.onload = function () {
        document.getElementById('msg').focus();
    }
</script>
