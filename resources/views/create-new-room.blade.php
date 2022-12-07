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
                    <x-label>{{__('Room Title')}}</x-label>
                    <x-input type="text" name="title" maxlength="128" placeholder="{{__('Room Title')}}"
                             maxlength="128"/>
                    @error('title')
                    <x-error-alert>{{$message}}</x-error-alert>
                    @enderror
                </div>
                <div>
                    <x-label class="p-0 m-0">{{__('Number of Players')}}</x-label>
                    <x-input type="number" name="size" value="2" min="2" max="16" placeholder="{{__('Players')}}"/>
                    @error('size')
                    <x-error-alert>{{$message}}</x-error-alert>
                    @enderror
                </div>
                <div class="pt-4">
                    <x-button type="submit" variant="primary" size="sm">{{__('Create Room')}}</x-button>
                </div>
            </div>
        </form>
    </x-layout.layout-card>
</x-app-layout>
