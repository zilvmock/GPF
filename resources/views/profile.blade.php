<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <x-layout.layout-card class="flex">
        <div class="overflow-hidden relative w-24 h-24 bg-gray-100 rounded-full dark:bg-gray-600">
            <img class="p-1 w-24 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                 src="{{asset('storage/'.$user->avatar)}}"
                 alt="User Avatar">
        </div>
        <div class="flex-col pl-4">
            <div>
                <h class="text-lg font-semibold text-gray-600 dark:text-gray-400">
                    {{$user->username}}
                </h>
            </div>
            <div class="py-2">
                <x-tooltip :id="'tltip-1'">Account creation date</x-tooltip>
                <span data-tooltip-target="tltip-1" class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                    <x-heroicon-o-calendar class="w-4 h-4 mr-2"/> {{date('Y-m-d', strtotime($user->created_at))}}
                </span>
                <x-tooltip :id="'tltip-2'">Email verification status</x-tooltip>
                <span data-tooltip-target="tltip-2" class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                    @if ($user->email_verified_at)
                        <x-heroicon-o-check-circle class="w-4 h-4 mr-2"/> Verified
                    @else
                        <x-heroicon-o-x-circle class="w-4 h-4 mr-2"/> Not Verified
                    @endif
                </span>
            </div>
            @php
                $platforms = [];
                array_push($platforms, $user->steam_link, $user->xbox_link, $user->origin_link, $user->epic_link);
            @endphp
            @if(array_filter($platforms, fn($value) => $value !== null))
                <div class="w-full max-w-sm p-4 border rounded-lg shadow-md sm:p-6 dark:bg-gray-800 dark:border-gray-700">
                    <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                        My Gaming Platforms
                    </h5>
                    <ul class="my-4 space-y-3">
                        @if($user->steam_link)
                            <li>
                                <a href="{{$user->steam_link}}" class="flex items-center p-3 font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <x-icons.steam class="w-6 h-6"/>
                                    <span class="flex-1 ml-3 whitespace-nowrap">Steam</span>
                                </a>
                            </li>
                        @endif
                        @if($user->xbox_link)
                        <li>
                            <a href="{{$user->xbox_link}}" class="flex items-center p-3 font-bold text-gray-900 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <x-icons.xbox class="w-6 h-6"/>
                                <span class="flex-1 ml-3 whitespace-nowrap">XBOX</span>
                            </a>
                        </li>
                        @endif
                        @if($user->origin_link)
                        <li>
                            <a href="{{$user->origin_link}}" class="flex items-center p-3 font-bold text-gray-900 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <x-icons.origin class="w-6 h-6"/>
                                <span class="flex-1 ml-3 whitespace-nowrap">Origin</span>
                            </a>
                        </li>
                        @endif
                        @if($user->epic_link)
                        <li>
                            <a href="{{$user->epic_link}}" class="flex items-center p-3 font-bold text-gray-900 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <x-icons.epic class="w-6 h-6"/>
                                <span class="flex-1 ml-3 whitespace-nowrap">Epic Games</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </x-layout.layout-card>
</x-app-layout>
