<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4">
            <h2 class="text-3xl font-semibold leading-tight">
                {{ __($game->name) }}
            </h2>
            <div class="flex flex-wrap">
                @php($game->genres = explode(', ', $game->genres))
                @foreach($game->genres as $genre)
                    <span
                        class="bg-gray-100 text-gray-800 font-bold text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                        {!! $genre !!}
                    </span>
                @endforeach
            </div>
            <div id="accordion-flush" data-accordion="collapse"
                 data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                 data-inactive-classes="text-gray-500 dark:text-gray-400">
                <h2 id="accordion-flush-heading-1">
                    <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-1" aria-expanded="false"
                            aria-controls="accordion-flush-body-1">
                        <span>{{__('Read Summary')}}</span>
                        <x-heroicon-o-chevron-down data-accordion-icon class="w-5 h-5 shrink-0"/>
                    </button>
                </h2>
                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                    <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700">
                        <p>{!! $game->summary !!}</p>
                    </div>
                </div>
            </div>
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
            <div class="flex justify-center items-center pb-2">
                <x-button type="button" variant="primary" size="sm"
                          class="sm:px-12"
                          href="{{route('create_new_room', ['game' => $game_slug, 'id' => $game_id])}}">
                    <x-heroicon-o-plus-sm class="w-5"/>
                    {{__('Create Room')}}
                </x-button>
            </div>
        @endif
        @livewire('rooms', [
           'game_slug' => $game_slug,
           'game_id' => $game_id,
       ])
    </x-layout.layout-card>
</x-app-layout>
