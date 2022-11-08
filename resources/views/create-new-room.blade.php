<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Create New Room') }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card>
        <x-label>Room Title</x-label>
        <form action="{{route('store_new_room', ['game' => $game['id']])}}" method="post">
            @csrf
            @method('put')
            <x-input type="text" name="title" placeholder="Room Title"/>
            {{--            <x-button type="button" variant="primary" size="sm">--}}
            {{--                <b>Create Room</b>--}}
            {{--            </x-button>--}}
            <button type="submit">create</button>
        </form>
    </x-layout.layout-card>
</x-app-layout>
