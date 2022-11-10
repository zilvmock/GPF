<div id="alert-2" class="flex items-center p-2 mt-2 mb-4 w-max bg-red-400 rounded-lg dark:bg-red-400" role="alert">
    <x-heroicon-o-exclamation-circle class="w-6 text-red-600"/>
    <span class="sr-only">Error</span>
    <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
        {{ $slot }}
    </div>
    <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-red-400 text-red-700 rounded-lg focus:ring-2 focus:ring-red-400 ml-2 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-400 dark:text-red-700 dark:hover:bg-red-300"
            data-dismiss-target="#alert-2" aria-label="Close">
        <span class="sr-only">Close</span>
        <x-heroicon-o-x class="w-5"/>
    </button>
</div>
