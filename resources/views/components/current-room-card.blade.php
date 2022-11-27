<div
    class="p-4 mb-6 w-fit bg-white rounded-lg border border-gray-200 shadow-md bg-gradient-to-br from-purple-500/50 dark:bg-gray-800 dark:border-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
        Join Back?
    </h5>
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
        You haven't left your last room. Do you want to join back?
    </p>
    <a href="{{route('show_room', ['game' => $game_slug, 'id' => $game_id, 'room' => $room_id])}}"
       class="inline-flex items-center py-1 px-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
        Join Back
        <x-heroicon-o-arrow-right class="w-5"/>
    </a>
</div>
