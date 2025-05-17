<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" :value="__('Email')" class="fieldset-legend text-gray-200 text-sm">Email</label>
            <input type="text" class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200 focus:border-indigo-500"  name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

        </div>

        <!-- Email Address -->
        {{-- <div >
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div> --}}
        <div class="mt-4">
            
            <label for="password" :value="__('Password')" class="fieldset-legend text-gray-200 text-sm">Password</label>
            <input
             type="password"
              id="password"
               class="input input-primary bg-gray-800 border border-gray-600 focus:text-white outline-none text-xs pl-3 w-full text-gray-200 focus:border-indigo-500" class="bg-gray-800" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
               
        </div>
        <!-- Password -->
        {{-- <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div> --}}

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div> --}}
        <div class="flex justify-between mt-4">

            <div class="flex items-center ">
                <input
                class="h-4 w-4 text-indigo-500 focus:ring-indigo-400 border-gray-600 rounded bg-gray-800"
                type="checkbox"
                name="remember"
                id="remember_me"
                />
                <label class="ml-2 block text-sm text-gray-400" for="remember-me"
                >Remember me</label
                >
            </div>
            @if (Route::has('password.request'))
                <a class=" text-sm text-gray-600 dark:text-indigo-500 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

        </div>
          
            <button class="w-full h-10 flex items-center text-center justify-center bg-indigo-500 text-gray-200 mt-4 rounded-md">
                {{ __('Log in') }}
            </button>

            
    </form>
</x-guest-layout>
