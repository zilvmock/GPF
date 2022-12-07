<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"/>

    {{-- Styles --}}
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
<div class="font-sans antialiased" x-data="mainState" :class="{dark: isDarkMode}" x-cloak>
    <div class="flex flex-col min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-bg dark:text-gray-200">
        {{ $slot }}

        <x-footer/>
    </div>

    <div class="fixed sm:top-10 top-20 sm:mt-12 mt-14 sm:right-10 right-10 sm:mr-4">
        @if(count(config('app.languages')) > 1)
            <div>
                <x-button type="button" variant="secondary" id="dropdownDefault"
                          data-dropdown-toggle="dropdown"
                          class="fixed sm:top-10 top-20 sm:mt-0 mt-2 sm:right-20 right-10 sm:mr-4">
                    {{ strtoupper(app()->getLocale()) }}
                    <x-heroicon-o-chevron-down class="w-4 h-4 ml-2"/>
                </x-button>
                <!-- Dropdown menu -->
                <div id="dropdown"
                     class="hidden z-20 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                    <ul class="text-left py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownDefault">
                        @foreach(config('app.languages') as $langLocale => $langName)
                            <li>
                                <a href="{{ url()->current() }}?change_language={{ $langLocale }}"
                                   class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ strtoupper($langLocale) }} ({{ $langName }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <script type="module">
                /* workaround because flowbite JS doesn't work on this page */
                document.getElementById('dropdownDefault').addEventListener('click', function () {
                    document.getElementById('dropdown').classList.toggle('hidden');
                });
                document.addEventListener('click', function (event) {
                    if (!event.target.closest('#dropdownDefault')) {
                        document.getElementById('dropdown').classList.add('hidden');
                    }
                });
            </script>
        @endif
    </div>
    <div class="fixed top-10 right-10">
        <x-button type="button" iconOnly variant="secondary" srText="Toggle dark mode" @click="toggleTheme">
            <x-heroicon-o-moon x-show="!isDarkMode" aria-hidden="true" class="w-6 h-6"/>
            <x-heroicon-o-sun x-show="isDarkMode" aria-hidden="true" class="w-6 h-6"/>
        </x-button>
    </div>
</div>
</body>

</html>
