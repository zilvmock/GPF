@if(session()->has('warning'))
    <div x-data="{show: true}" x-show="show" style="display: none"
         x-init="setTimeout(() => show = false, 60000)"
         id="toast-warning"
         class="z-10 fixed bottom-5 right-5 flex items-center p-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
         role="alert">
        <div
            class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
            <x-heroicon-s-exclamation class="w-7"/>
            <span class="sr-only">Warning icon</span>
        </div>
        <div class="ml-3 text-sm font-normal">{{session('warning')}}</div>
        <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <x-heroicon-o-x class="w-5"/>
        </button>
    </div>
@endif


