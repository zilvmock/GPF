<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-3xl font-semibold leading-tight">
                {{ __('Browse Games') }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card>
        @if(auth()->user()->current_room_id != 0)
            <x-current-room-card>
                <x-slot:game_slug>{{auth()->user()->room->game->slug}}</x-slot:game_slug>
                <x-slot:game_id>{{auth()->user()->room->game_id}}</x-slot:game_id>
                <x-slot:room_id>{{auth()->user()->current_room_id}}</x-slot:room_id>
            </x-current-room-card>
        @endif
        <div class="mb-8">
            <form action="{{route('browse')}}">
                <div class="flex relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-heroicon-o-search class="w-5 h-5 text-gray-500 dark:text-gray-400"/>
                    </div>
                    <!--suppress HtmlFormInputWithoutLabel -->
                    <input type="search" name="search" id="default-search"
                           class="block w-full p-2 pl-10 mr-5 text-sm text-gray-900 border border-gray-300
                           rounded-lg bg-gray-50 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700
                           dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                           dark:focus:ring-purple-500 dark:focus:border-purple-500"
                           placeholder="{{__('Search for a specific game...')}}" value="{{$searchValue ?? ''}}">

                    <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch" data-dropdown-placement="bottom"
                            class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none
                            focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex
                            items-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800"
                            type="button">
                        {{__('Genres')}}
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownSearch" class="z-10 hidden bg-white rounded shadow w-60 dark:bg-gray-700">
                        <div class="p-3">
                            <label for="input-group-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                              clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" id="input-group-search"
                                       class="block w-full p-2 pl-10 text-sm text-gray-900 border
                                       border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500
                                       focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500
                                       dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                                       dark:focus:border-blue-500" placeholder="{{__('Search genres')}}">
                            </div>
                        </div>
                        <ul class="improve-scroll-bar h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
                            @foreach($allGenres as $genre)
                                <li>
                                    <div class="flex items-center pl-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        @if(in_array($genre, $searchGenres) || count($searchGenres)<2)
                                            <input checked id="checkbox-item-{{$loop->index}}" type="checkbox" value=""
                                                   class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300
                                                   rounded focus:ring-purple-500 dark:focus:ring-purple-600
                                                   dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600
                                                   dark:border-gray-500 checked">
                                        @else
                                            <input id="checkbox-item-{{$loop->index}}" type="checkbox" value=""
                                                   class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300
                                                   rounded focus:ring-purple-500 dark:focus:ring-purple-600
                                                   dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600
                                                   dark:border-gray-500">
                                        @endif
                                        <label for="checkbox-item-{{$loop->index}}"
                                               class="w-full py-2 ml-2 text-sm font-medium text-gray-900
                                               rounded dark:text-gray-300">{{$genre}}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <script>
                            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

                            function selectAll() {
                                checkboxes.forEach(checkbox => {
                                    checkbox.checked = true;
                                    checkbox.parentElement.classList.add('checked');
                                });
                            }

                            function deselectAll() {
                                checkboxes.forEach((checkbox) => {
                                    checkbox.checked = false;
                                });
                            }
                        </script>

                        <a href="#" onclick="selectAll()"
                           class="flex items-center p-3 text-sm font-medium border-t
                           border-gray-200 bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700
                           dark:hover:bg-gray-600 hover:underline">
                            <x-heroicon-o-check-circle class="w-5 h-5 mr-2"/>
                            {{__('Select all')}}
                        </a>
                        <a href="#" onclick="deselectAll()"
                           class="rounded flex items-center p-3 text-sm font-medium  border-t
                           border-gray-200 bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700
                           dark:hover:bg-gray-600 hover:underline">
                            <x-heroicon-o-x-circle class="w-5 h-5 mr-2"/>
                            {{__('Deselect all')}}
                        </a>
                    </div>
                    <input type="hidden" name="genres">
                    <script type="module">
                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', (event) => {
                                if (event.target.checked) {
                                    event.target.parentElement.classList.add('checked');
                                } else {
                                    event.target.parentElement.classList.remove('checked');
                                }
                            });
                        });

                        document.getElementById('input-group-search').addEventListener('input', function (e) {
                            let filter = e.target.value.toUpperCase();
                            let list = document.getElementById('dropdownSearch').getElementsByTagName('li');
                            for (let i = 0; i < list.length; i++) {
                                let label = list[i].getElementsByTagName('label')[0];
                                if (label.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                    list[i].style.display = '';
                                } else {
                                    list[i].style.display = 'none';
                                }
                            }
                        });

                        function setSelectedGenres() {
                            let selectedGenres = [];
                            checkboxes.forEach((checkbox) => {
                                if (checkbox.checked) {
                                    selectedGenres.push(checkbox.parentElement.getElementsByTagName('label')[0].innerHTML);
                                }
                            });
                            document.querySelector('input[name="genres"]').value = selectedGenres.join(', ');
                        }

                        document.getElementById('search-btn').addEventListener('click', function () {
                            setSelectedGenres();
                        });
                    </script>

                    <x-button class="ml-2 sm:px-8" type="submit" variant="primary" size="sm" id="search-btn">
                        {{__('Search')}}
                    </x-button>
                </div>
            </form>
        </div>
        <div class="grid xl:grid-cols-6 lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 gap-4">
            @if($games->count() == 0)
                <p class="pb-64">{{__('No games were found')}}</p>
            @endif
            @foreach($games as $game)
                <x-game-card>
                    <x-slot:gameId>{{$game->id}}</x-slot:gameId>
                    <x-slot:route>{{route('rooms', ['game' => $game->slug, 'id' => $game->id])}}</x-slot:route>
                    <x-slot:cover>{{$game->cover}}</x-slot:cover>
                    <x-slot:name>{{$game->name}}</x-slot:name>
                    <x-slot:genres>{{$game->genres}}</x-slot:genres>
                    <x-slot:summary>{{Str::words($game->summary, 50)}}</x-slot:summary>
                    <x-slot:room_count>{{$game->room_count}}</x-slot:room_count>
                </x-game-card>
            @endforeach
        </div>
        <div class="pt-12">
            {{$games->links()}}
        </div>
    </x-layout.layout-card>
</x-app-layout>
