<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Browse Game') }}
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
        <div class="grid overflow-hidden grid-cols-4 auto-rows-auto gap-4">
            @foreach($games as $game)
                <x-game-card :gameId="$game->id">
                    <x-slot:route>{{route('rooms', ['game' => $game->slug, 'id' => $game->id])}}</x-slot:route>
                    <x-slot:title>{{$game->title}}</x-slot:title>
                    <x-slot:description>{{$game->description}}</x-slot:description>
                </x-game-card>
            @endforeach
        </div>
    </x-layout.layout-card>
</x-app-layout>
