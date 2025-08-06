@extends('frontend.app')
@section('title', 'Log In')

@section('content')
    <!-- Banner Section -->
    <section>
        <div class="auth-banner-image">
            <div class="banner-text-wrapper text-center" data-aos="zoom-out" data-aos-duration="800">
                <h1 class="fw-700 banner-headline">Log In</h1>
            </div>
        </div>
    </section>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="main">
        <div class="form-wrapper">
            <!-- Sign-In Image -->
            <div class="signin-image">
                <img src="{{ asset('frontend/images/auth/cuate.png') }}" alt="Sign-in image" class="img-fluid" />
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <div class="center">
                    <h4>Login To Your Account</h4>
                </div>

                <form class="signin-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="inputfield"
                            placeholder="Email Address" required autofocus autocomplete="username" />
                        @error('email')
                            <div class="mt-2 text-red-600 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="pass-container">
                        <input id="passwordInput" type="password" name="password" placeholder="Password" class="inputfield"
                            required autocomplete="current-password" />

                        <span class="authicon" onclick="togglePasswordVisibility('passwordInput', 'authIconHide', 'authIconShow')">

                            <img id="authIconHide" src="{{ asset('frontend/images/PassHideIcon.svg') }}"
                                alt="Hide icon" class="hiddenicon" />
                            <img id="authIconShow" src="{{ asset('frontend/images/PassShowIcon.svg') }}"
                                alt="Show icon" class="seenicon" style="display: none;" />
                        </span>
                        @error('password')
                            <div class="mt-2 text-red-600 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="fpass-flex">
                        <div class="flex mt">
                            <div>
                                <input type="checkbox" name="remember" id="remember" />
                            </div>
                            <div class="rem">
                                <label for="remember">Remember me</label>
                            </div>
                        </div>
                        <div class="fpass">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </div>
                    {{-- <div class="google-signin mt">
                        <a href="{{ route('provider') }}"
                           class="btn btn-danger"
                           style="text-decoration: none; color: white; display: inline-flex; align-items: center; padding: 10px 15px; border-radius: 5px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                                 alt="Google Logo"
                                 style="width: 20px; height: 15px; margin-right: 10px;">
                            Sign in with Google
                        </a>
                    </div> --}}


                    <!-- Sign In Button -->
                    <div class="signinBtn-wrapper">
                        <button class="signinBtn" type="submit">{{ __('Sign In') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
