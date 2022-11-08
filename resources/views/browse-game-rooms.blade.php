<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Browse Game Rooms') }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card>
        @if(auth()->user()->current_room_id != 0)
            <x-current-room-card>
                <x-slot:game_slug>{{$game_slug}}</x-slot:game_slug>
                <x-slot:game_id>{{$game_id}}</x-slot:game_id>
                <x-slot:room_id>{{auth()->user()->current_room_id}}</x-slot:room_id>
            </x-current-room-card>
        @else
            <x-button type="button" variant="primary" size="sm"
                      href="{{route('create_new_room', ['game' => $game_slug, 'id' => $game_id])}}">
                <x-heroicon-o-plus-sm class="w-5"/>
                Create Room
            </x-button>
        @endif
        @livewire('rooms', [
               'game_slug' => $game_slug,
               'game_id' => $game_id,
           ])
    </x-layout.layout-card>
</x-app-layout>
