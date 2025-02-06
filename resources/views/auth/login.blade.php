<x-guest-layout>
    <div class="main-page">
        <div class="home-container">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-box">
                    <!-- Email Address -->
                    <x-input-label for="email" :value="__('Email')" />
                    <div>
                        <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="mt-4">


                        <x-text-input id="password" class=""
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="">
                        <label for="remember_me" class="">
                            <input id="remember_me" type="checkbox" class="" name="remember">
                            <span class="">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div>
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button class="btn-primary">
                            {{ __('Log in') }}
                        </button>
                    </div>
                </div>
            </form>
            <div class="mt-4 text-center">
                <p>{{ __('Don\'t have an account?') }} <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500">{{ __('Register here') }}</a></p>
            </div>
        </div>
    </div>
    <!-- Session Status -->

</x-guest-layout>
