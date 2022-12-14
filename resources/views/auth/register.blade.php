<x-guest-layout>
    <x-auth-card>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid gap-6">
                {{-- Username --}}
                <div class="space-y-2">
                    <x-label for="username" :value="__('Username')"/>
                    <x-input-with-icon-wrapper>
                        <div class="flex">
                            <x-slot name="icon">
                                <x-heroicon-o-user aria-hidden="true" class="w-5 h-5"/>
                            </x-slot>
                            <x-input withicon id="username" class="block w-full" type="text" name="username"
                                     :value="old('username')"
                                     required maxlength="16" placeholder="{{ __('Username') }}"/>
                            <button type="button"
                                    class="inline-flex items-center transition-colors font-medium select-none
                                    focus:outline-none focus:ring focus:ring-offset-2 focus:ring-offset-white
                                    dark:focus:ring-offset-dark-eval-2 bg-purple-500 text-white hover:bg-purple-600
                                    focus:ring-purple-500 px-2.5 py-1.5 text-sm rounded-md ml-2"
                                    id="check_username">
                                {{__('Check')}}
                            </button>
                        </div>
                            <script type="module">
                                $(document).ready(function () {
                                    $('#check_username').click(function () {
                                        $.ajax({
                                            url: '{{route('check_username')}}',
                                            type: 'GET',
                                            data: {
                                                username: $('input[id=username]').val(),
                                            },
                                        }).done(function (data) {
                                            let input = $('input[id=username]');
                                            input.removeClass('focus:ring-purple-500 focus:ring');
                                            if (data === 'taken') {
                                                input.removeClass('focus:ring-green-500 ring-green-500');
                                                input.addClass('focus:ring-red-500 ring ring-red-500');
                                            } else {
                                                input.removeClass('focus:ring-red-500 ring-red-500');
                                                input.addClass('focus:ring-green-500 ring ring-green-500');
                                            }
                                        });
                                    });
                                });
                            </script>
                    </x-input-with-icon-wrapper>
                </div>

                {{-- Email Address --}}
                <div class="space-y-2">
                    <x-label for="email" :value="__('Email')"/>
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5"/>
                        </x-slot>
                        <x-input withicon id="email" class="block w-full" type="email" name="email"
                                 :value="old('email')" maxlength="32" required placeholder="{{ __('Email') }}"/>
                    </x-input-with-icon-wrapper>
                </div>

                {{-- Password --}}
                <div class="space-y-2">
                    <x-label for="password" :value="__('Password')"/>
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5"/>
                        </x-slot>
                        <x-input withicon id="password" class="block w-full" type="password" name="password" required
                                 autocomplete="new-password" maxlength="64" placeholder="{{ __('Password') }}"/>
                    </x-input-with-icon-wrapper>
                </div>

                {{-- Confirm Password --}}
                <div class="space-y-2">
                    <x-label for="password_confirmation" :value="__('Confirm Password')"/>
                    <x-input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5"/>
                        </x-slot>
                        <x-input withicon id="password_confirmation" class="block w-full" type="password"
                                 name="password_confirmation" maxlength="64" required placeholder="{{ __('Confirm Password') }}"/>
                    </x-input-with-icon-wrapper>
                </div>

                <div>
                    <x-button type="submit" class="justify-center w-full gap-2">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true"/>
                        <span>{{ __('Register') }}</span>
                    </x-button>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
