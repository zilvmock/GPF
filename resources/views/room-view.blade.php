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
                <div class="flex flex-col bg-gray-50 rounded-lg dark:bg-gray-700">
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
                               class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300
                               focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-800 dark:border-gray-600
                               dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500"
                               placeholder="{{__('Your message')}}..."
                               maxlength="512"/>
                        <button type="button"
                                class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer
                                hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white
                                dark:hover:bg-gray-600"
                                id="files-btn">
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12
                                 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd">
                                </path>
                            </svg>
                            <span class="sr-only">Upload image</span>
                        </button>
                        <script type="module">
                            document.getElementById('files-btn').addEventListener('click', function () {
                                document.getElementById('img_div').classList.toggle('hidden');
                            });
                        </script>
                        <button id="mega-menu-dropdown-button" data-dropdown-toggle="mega-menu-dropdown" type="button"
                                class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100
                                dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Add emoji</span>
                        </button>
                    </div>
                    <div class="hidden" id="img_div">
                        <form action="" class="p-1">
                            <input class="pl-6" id="image" type="file" name="image" accept="image/*"/>
                        </form>
                        <p id="error-msg" class=" text-red-500 p-1 ml-2"></p>
                    </div>
                    @php if (Cache::has('emojis')) { $emojis = Cache::get('emojis'); } @endphp
                    @if($emojis)
                        <div>
                            <div id="mega-menu"
                                 class="hidden justify-between items-center w-full text-sm md:flex md:w-auto md:order-1">
                                <div id="mega-menu-dropdown"
                                     class="hidden grid improve-scroll-bar overflow-x-auto h-1/2 absolute z-10
                                 grid-cols-1 w-auto text-sm bg-white rounded-lg border border-gray-100 shadow-md
                                 dark:border-gray-700 md:grid-cols-3 dark:bg-gray-700">
                                    @foreach($emojis as $emoji)
                                        <div class="p-1 text-gray-900 dark:text-white">
                                            <button type="button"
                                                    class="text-xl inline-flex justify-center p-2 text-gray-500 rounded-lg
                                                    cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400
                                                    dark:hover:text-white dark:hover:bg-gray-600">
                                                {{$emoji}}
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <script type="module">
                                document.querySelectorAll('#mega-menu-dropdown button').forEach((button) => {
                                    button.addEventListener('click', (event) => {
                                        document.getElementById('msg').value += event.target.innerText;
                                    });
                                });
                            </script>
                        </div>
                    @endif
                    <script type="module">
                        $(document).ready(function () {
                            let folder;
                            $('#image').on('change', function () {
                                let file = this.files[0];
                                if (file.type.match('image.*')) {
                                    if (file.size < 2097152) {
                                        let formData = new FormData();
                                        formData.append('image', file);
                                        $.ajax({
                                            url: '/upload',
                                            type: 'POST',
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            headers: {
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            },
                                            success: function (data) {
                                                folder = data.folder;
                                            }
                                        });
                                    } else {
                                        $('#error-msg').text('- File size is too big, please use files less than 2MB!');
                                        $('#image').val('');
                                    }
                                } else {
                                    $('#error-msg').text('- File type is not supported, please use images!');
                                    $('#image').val('');
                                }
                            });

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
                                        message: $('#msg').val() ?? '',
                                        folder: folder ?? null,
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                }).done(function () {
                                    input.val('');
                                    input.focus();
                                    $('#image').val('');
                                    let $imgDiv = $('#img_div');
                                    if (!$imgDiv.hasClass("hidden")) {
                                        $imgDiv.toggleClass("hidden");
                                    }
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
