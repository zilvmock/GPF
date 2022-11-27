<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-3xl font-semibold leading-tight">
                {{ __('Create New Room') }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card>
        <form action="{{route('store_new_room', ['game' => $game['id']])}}" method="post">
            @csrf
            @method('put')
            <div class="flex-col space-y-2">
                <div>
                    <x-label>Room Title</x-label>
                    <x-input type="text" name="title" maxlength="128" placeholder="Room Title" maxlength="64"/>
                    @error('title')
                    <x-error-alert>{{$message}}</x-error-alert>
                    @enderror
                </div>
                <div>
                    <x-label class="p-0 m-0">Number of Players</x-label>
                    <x-input type="number" name="size" value="2" min="2" max="16" placeholder="Players"/>
                    @error('size')
                    <x-error-alert>{{$message}}</x-error-alert>
                    @enderror
                </div>
                <div class="pt-4">
                    <x-button type="submit" variant="primary" size="sm">Create Room</x-button>
                </div>
            </div>
        </form>
    </x-layout.layout-card>
</x-app-layout>
