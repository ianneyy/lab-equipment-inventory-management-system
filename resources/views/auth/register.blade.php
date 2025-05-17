<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" :value="__('Name')" class="fieldset-legend text-gray-200 text-sm">Name</label>
            <input type="text" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200 focus:border-indigo-500"  name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />

        </div>
        {{-- <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div> --}}
        <!-- Email Address -->

        <div class="mt-4">
            <label for="email" :value="__('Email')" class="fieldset-legend text-gray-200 text-sm">Email</label>
            <input id="email" type="text" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200 focus:border-indigo-500"  name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>

        
        {{-- <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}

        <!-- Password -->

        <div class="mt-4">
            <label for="password" :value="__('Password')" class="fieldset-legend text-gray-200 text-sm">Password</label>
            <input id="password" type="password" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200 focus:border-indigo-500"  name="password" required autocomplete="password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>
        {{-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> --}}

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" :value="__('Confirm Password')" class="fieldset-legend text-gray-200 text-sm">Confirm Password</label>
            <input id="password" type="password" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200 focus:border-indigo-500"  name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        </div>
        {{-- <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> --}}

            {{-- <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> --}}
            <button class="w-full h-10 flex items-center text-center justify-center bg-indigo-500 text-gray-200 mt-4 rounded-md">
                {{ __('Register') }}
            </button>
            {{-- <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button> --}}
    </form>
</x-guest-layout>
