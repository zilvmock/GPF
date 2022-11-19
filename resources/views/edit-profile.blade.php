<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Edit Profile') }}
            </h2>
        </div>
    </x-slot>
    <x-layout.layout-card class="md:flex-col md:space-x-0 space-x-2 md:space-y-2 space-y-0">
        <a href="{{route('show_profile', auth()->user()->username)}}"
           class="md:mb-0 md:ml-0 mb-2 ml-2 border border-gray-500 rounded p-1 w-max h-max flex items-center text-gray-400 dark:text-gray-500">
            <x-heroicon-o-arrow-left class="w-5 h-5"/>
            Profile
        </a>
        <x-layout.layout-card-2>
            <form method="POST" action="{{route('store_profile')}}">
                @csrf
                @method('PUT')
                <div class="xl:grid gap-6 gap-y-3 grid-cols-3">
                    <div class="grid grid-cols-1  grid-rows-2 place-items-center">
                        <div class="overflow-hidden relative w-24 h-24 bg-gray-100 rounded-full dark:bg-gray-600">
                            <img class="p-1 w-24 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                                 src="{{asset('storage/avatars/'.auth()->user()->avatar)}}"
                                 alt="User Avatar">
                        </div>
                        <input class="h-full w-full my-10" id="avatar" type="file" name="avatar" />
                    </div>
                    <div class="xl:pt-0 pt-8">
                        <!-- Username -->
                        <div class="space-y-2">
                            <x-label for="username" :value="__('Username')"/>
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-user aria-hidden="true" class="w-5 h-5"/>
                                </x-slot>
                                <x-input withicon id="name" class="block w-full" type="text" name="username"
                                         :value="old('username', auth()->user()->username)"
                                         required autofocus placeholder="{{ __('Username') }}"/>
                            </x-input-with-icon-wrapper>
                            @error('username')
                            <x-error-alert>{{$message}}</x-error-alert>
                            @enderror
                        </div>
                        <!-- Email Address -->
                        <div class="space-y-2 pt-4">
                            <x-label for="email" :value="__('Email')"/>
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5"/>
                                </x-slot>
                                <x-input withicon id="email" class="block w-full" type="email" name="email"
                                         :value="old('email', auth()->user()->email)" required placeholder="{{ __('Email') }}"/>
                            </x-input-with-icon-wrapper>
                            @error('email')
                            <x-error-alert>{{$message}}</x-error-alert>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <!-- Password -->
                        <div class="space-y-2 xl:pt-0 pt-4">
                            <x-label for="password" :value="__('Password')"/>
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5"/>
                                </x-slot>
                                <x-input withicon id="password" class="block w-full" type="password" name="password"
                                         placeholder="{{ __('Password') }}"/>
                            </x-input-with-icon-wrapper>
                            @error('password')
                            <x-error-alert>{{$message}}</x-error-alert>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="space-y-2 pt-4 xl:pb-0 pb-6">
                            <x-label for="password_confirmation" :value="__('Confirm Password')"/>
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5"/>
                                </x-slot>
                                <x-input withicon id="password_confirmation" class="block w-full" type="password"
                                         name="password_confirmation" placeholder="{{ __('Confirm Password') }}"/>
                            </x-input-with-icon-wrapper>
                            @error('password_confirmation')
                            <x-error-alert>{{$message}}</x-error-alert>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <x-button class="justify-center xl:w-max w-full">
                        <span>{{ __('Update Settings') }}</span>
                    </x-button>
                </div>
            </form>
        </x-layout.layout-card-2>
        <x-layout.layout-card-2>
            <form method="POST" action="{{route('store_profile_acc')}}">
                @csrf
                @method('PUT')
                <div class="xl:grid gap-6 gap-y-3 grid-cols-2">
                    <div class="xl:pt-0 pt-8">
                        <!-- Steam -->
                        <div class="space-y-2">
                            <x-label for="steam" :value="__('Steam')"/>
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-icons.steam class="w-5 h-5"/>
                                </x-slot>
                                <x-input withicon id="steam_usr" class="block w-full" type="text" name="steam_usr"
                                         :value="old('steam_usr', auth()->user()->steam_usr)"
                                         placeholder="{{ __('Steam Profile Name') }}"
                                         maxlength="30"/>
                            </x-input-with-icon-wrapper>
                        </div>

                        <!-- Origin -->
                        <div class="space-y-2 pt-4">
                            <x-label for="origin" :value="__('Origin')"/>
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-icons.origin class="w-5 h-5"/>
                                </x-slot>
                                <x-input withicon id="origin_usr" class="block w-full" type="text" name="origin_usr"
                                         :value="old('origin_usr', auth()->user()->origin_usr)"
                                         placeholder="{{ __('Origin Profile Name') }}"
                                         maxlength="30"/>
                            </x-input-with-icon-wrapper>
                        </div>
                    </div>
                    <div>
                        <!-- Epic Games -->
                        <div class="space-y-2 xl:pt-0 pt-4">
                            <x-label for="epic" :value="__('Epic Games')"/>
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-icons.epic class="w-5 h-5"/>
                                </x-slot>
                                <x-input withicon id="epic_usr" class="block w-full" type="text" name="epic_usr"
                                         :value="old('epic_usr', auth()->user()->epic_usr)"
                                         placeholder="{{ __('Epic Games Profile Name') }}"
                                         maxlength="30"/>
                            </x-input-with-icon-wrapper>
                        </div>

                        <!-- XBOX -->
                        <div class="space-y-2 pt-4">
                            <x-label for="xbox" :value="__('XBOX')"/>
                            <x-input-with-icon-wrapper>
                                <x-slot name="icon">
                                    <x-icons.xbox class="w-5 h-5"/>
                                </x-slot>
                                <x-input withicon id="xbox_usr" class="block w-full" type="text" name="xbox_usr"
                                         :value="old('xbox_usr', auth()->user()->xbox_usr)"
                                         placeholder="{{ __('XBOX Profile Name') }}"
                                         maxlength="30"/>
                            </x-input-with-icon-wrapper>
                        </div>
                    </div>
                </div>
                <div class="xl:flex justify-between space-y-4">
                    <div class="flex text-gray-400 italic py-3">
                        <x-heroicon-o-question-mark-circle class="w-4 h-4"/>
                        <small>Provide your gaming platform account names, so other user can find you.</small>
                    </div>
                    <x-button class="justify-center xl:w-max w-full">
                        <span>{{ __('Update Platforms') }}</span>
                    </x-button>
                </div>
            </form>
        </x-layout.layout-card-2>
    </x-layout.layout-card>
    @section('scripts')
        <script type="module">
            const inputElement = document.querySelector('input[id="avatar"]');
            FilePond.setOptions({
                credits: false,
                maxFiles: 1,
                maxFileSize: '2MB',
                minFileSize: '1KB',
                instantUpload: false,
                server: {
                    url: '/upload',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
            const pond = FilePond.create(inputElement);
        </script>
    @endsection
</x-app-layout>
