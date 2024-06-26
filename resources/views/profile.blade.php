<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-3xl font-semibold leading-tight">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card class="sm:flex">
        <div>
            {{-- Profile --}}
            <div class="sm:flex justify-between sm:text-left text-center mb-4">
                <div class="sm:flex pl-4">
                    <div
                        class="sm:mx-0 mx-auto overflow-hidden relative w-24 h-24 bg-gray-100 rounded-full dark:bg-gray-600">
                        <img class="p-1 w-24 h-24 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                             src="{{asset('./storage/avatars/'.auth()->user()->avatar)}}"
                             alt="User Avatar">
                    </div>
                    <div class="flex-col sm:ml-4">
                        <div>
                            <h class="text-lg font-semibold text-gray-600 dark:text-gray-400">
                                {{$user->username}}
                            </h>
                        </div>
                        <div class="py-2">
                            <x-tooltip :id="'tltip-1'">{{__('Account creation date')}}</x-tooltip>
                            <span data-tooltip-target="tltip-1"
                                  class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                                <x-heroicon-o-calendar class="w-4 h-4 mr-2"/> {{date('Y-m-d', strtotime($user->created_at))}}
                            </span>
                            <x-tooltip :id="'tltip-2'">{{__('Email verification status')}}</x-tooltip>
                            <span data-tooltip-target="tltip-2"
                                  class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-300">
                                @if ($user->email_verified_at)
                                    <x-heroicon-o-check-circle class="w-4 h-4 mr-2"/> {{__('Verified')}}
                                @else
                                    <x-heroicon-o-x-circle class="w-4 h-4 mr-2"/> {{__('Not Verified')}}
                                @endif
                            </span>
                        </div>
                    </div>

                </div>
                @if(auth()->user()->username == $user->username)
                    <div>
                        <x-button type="button" variant="primary" size="sm"
                                  href="{{route('edit_profile')}}">
                            <x-heroicon-o-cog class="w-5 h-5"/>
                            {{__('Edit Profile')}}
                        </x-button>
                    </div>
                @endif
            </div>
            {{-- Gaming Platforms --}}
            <div id="platform_div" class="sm:flex-none flex sm:justify-start justify-center">
                @php
                    $platforms = [];
                    array_push($platforms, $user->steam_usr, $user->xbox_usr, $user->origin_usr, $user->epic_usr);
                @endphp
                @if(array_filter($platforms, fn($value) => $value !== null))
                    <div
                        class="sm:w-max w-4/5 p-4 border rounded-lg shadow-md sm:p-6 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                            {{__('My Gaming Platforms')}}
                        </h5>
                        <ul class="my-4 sm:flex sm:space-x-2 sm:space-y-0 space-y-2">
                            @if($user->steam_usr)
                                <li>
                                <span onclick="copyToClipboard('steam')"
                                      class="flex items-center p-3 text-base font-bold text-gray-900
                                             rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow
                                             dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <x-icons.steam class="w-6 h-6"/>
                                    <span class="flex-1 ml-3">
                                        Steam
                                        <p id="steam_usr_cp"
                                           class="text-sm font-light text-gray-500 dark:text-gray-300">
                                            {{$user->steam_usr}}
                                        </p>
                                    </span>
                                </span>
                                </li>
                            @endif
                            @if($user->origin_usr)
                                <li>
                            <span onclick="copyToClipboard('origin')"
                                  class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg
                                         bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600
                                         dark:hover:bg-gray-500 dark:text-white">
                                <x-icons.origin class="w-6 h-6"/>
                                <span class="flex-1 ml-3">
                                    Origin
                                    <p id="origin_usr_cp" class="text-sm font-light text-gray-500 dark:text-gray-300">
                                        {{$user->origin_usr}}
                                    </p>
                                </span>
                            </span>
                                </li>
                            @endif
                            @if($user->epic_usr)
                                <li>
                            <span onclick="copyToClipboard('epic')"
                                  class="flex items-center p-3 text-base font-bold text-gray-900
                                  rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow
                                  dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <x-icons.epic class="w-6 h-6"/>
                                <span class="flex-1 ml-3">
                                    Epic Games
                                    <p id="epic_usr_cp" class="text-sm font-light text-gray-500 dark:text-gray-300">
                                        {{$user->epic_usr}}
                                    </p>
                                </span>
                            </span>
                                </li>
                            @endif
                            @if($user->xbox_usr)
                                <li>
                                <span onclick="copyToClipboard('xbox')"
                                      class="flex items-center p-3 text-base font-bold text-gray-900
                                      rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow
                                      dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                    <x-icons.xbox class="w-6 h-6"/>
                                    <span class="flex-1 ml-3">
                                        XBOX
                                        <p id="xbox_usr_cp" class="text-sm font-light text-gray-500 dark:text-gray-300">
                                            {{$user->xbox_usr}}
                                        </p>
                                    </span>
                                </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </x-layout.layout-card>
</x-app-layout>
<script>
    function copyToClipboard($id) {
        navigator.clipboard.writeText(document.getElementById($id + '_usr_cp').innerText);
    }
</script>
