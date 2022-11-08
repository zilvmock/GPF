<div id="room-{{$roomId}}"
     class="flex items-center content-center justify-between p-6 max-w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <h1 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{$title}}</h1>
    <x-button type="button" variant="primary" size="sm" wire:click="checkChat({{$roomId}})">
        <b>Join</b>
        <x-heroicon-o-chevron-right class="w-5"/>
    </x-button>
</div>
