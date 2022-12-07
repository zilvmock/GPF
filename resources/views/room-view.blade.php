<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-3xl font-semibold leading-tight break-all">
                {{ __($room_title) }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card>
        <div class="md:flex my-4 md:space-x-2 space-y-2">
            <div>
                <x-layout.layout-card-2 class="h-max mt-2 mb-2">
                    @livewire('room-users', ['room_id' => $room, 'room_size' => $room_size])
                </x-layout.layout-card-2>
                @livewire('room-controls', [
                      'room_id' => $room,
                      'game_slug' => $game,
                      'game_id' => $id,
                      'room_title' => $room_title,
                      'room_lock' => $room_lock,
                   ])
            </div>
            <x-layout.layout-card-2 class="md:w-screen">
                <div class="improve-scroll-bar h-96 overflow-y-auto"
                     style="display: flex; flex-direction: column-reverse;">
                    @livewire('chat', [
                        'room_id' => $room,
                    ])
                </div>
                <div>
                    <label for="chat" class="sr-only">{{__('Your message')}}</label>
                    <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                        <button type="submit"
                                id="send_message"
                                class="inline-flex justify-center p-2 text-purple-600 rounded-full cursor-pointer
                                 hover:bg-purple-100 dark:text-purple-500 dark:hover:bg-gray-600">
                            <x-heroicon-s-paper-airplane class="w-6 h-6 rotate-90"/>
                            <span class="sr-only">{{__('Send message')}}</span>
                        </button>
                        <!--suppress HtmlFormInputWithoutLabel -->
                        <input type="text" name="message" id="msg"
                               class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                               placeholder="{{__('Your message')}}..."
                               maxlength="512"/>
                    </div>
                    <script type="module">
                        $(document).ready(function () {
                            let input = $('#msg');
                            input.keypress(function () {
                                if (event.keyCode === 13) {
                                    $('#send_message').click();
                                }
                            });
                            $('#send_message').click(function () {
                                $.ajax({
                                    url: '{{route('send_message', ['room' => $room])}}',
                                    type: 'PUT',
                                    data: {
                                        room: '{{$room}}',
                                        message: $('#msg').val(),
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                }).done(function () {
                                    input.val('');
                                    input.focus();
                                });
                            });
                        });
                    </script>
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
