<div class="flex items-center justify-between flex-shrink-0 px-1 max-h-12">
    {{-- Logo --}}
    <a href="{{ route('browse') }}" class="inline-flex items-center gap-2">
        <x-application-logo aria-hidden="true" class="w-14 h-auto"/>
    </a>

    {{-- Toggle button --}}
    <x-button type="button" iconOnly srText="Toggle sidebar" variant="secondary"
              x-show="isSidebarOpen || isSidebarHovered" @click="isSidebarOpen = !isSidebarOpen">
        <x-icons.menu-fold-right x-show="!isSidebarOpen" aria-hidden="true"
                                 class="hidden w-6 h-6 lg:block dark:text-gray-200"/>
        <x-icons.menu-fold-left x-show="isSidebarOpen" aria-hidden="true"
                                class="hidden w-6 h-6 lg:block dark:text-gray-200"/>
        <x-heroicon-o-x aria-hidden="true" class="w-6 h-6 lg:hidden dark:text-gray-200"/>
    </x-button>
</div>
