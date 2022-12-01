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
                           class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300
                           rounded-lg bg-gray-50 focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700
                           dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                           dark:focus:ring-purple-500 dark:focus:border-purple-500"
                           placeholder="Search for a specific game..." value="{{$searchValue ?? ''}}">
                    <x-button class="ml-2 sm:px-8" type="submit" variant="primary" size="sm">
                        Search
                    </x-button>
                </div>
            </form>
        </div>
        <div class="grid xl:grid-cols-6 lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 gap-4">
            @if($games->count() == 0)
                <p>No games was found</p>
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
