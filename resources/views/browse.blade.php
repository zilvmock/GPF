<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Browse Games') }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card>
        @if(auth()->user()->current_room_id != null)
            <x-current-room-card>
                <x-slot:game_slug>{{auth()->user()->room->game->slug}}</x-slot:game_slug>
                <x-slot:game_id>{{auth()->user()->room->game_id}}</x-slot:game_id>
                <x-slot:room_id>{{auth()->user()->current_room_id}}</x-slot:room_id>
            </x-current-room-card>
        @endif
        <div class="grid xl:grid-cols-6 lg:grid-cols-4 md:grid-cols-4 sm:grid-cols-2 gap-4">
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
