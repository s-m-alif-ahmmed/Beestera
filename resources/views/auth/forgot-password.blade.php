@extends('frontend.app')
@section('title', 'Forgot Password')
@section('content')
    <!-- Banner section starts -->
    <section>
        <div>
            <div class="auth-banner-image">
                <div class="banner-text-wrapper text-center" data-aos="zoom-out" data-aos-duration="800">
                    <h1 class="fw-700 banner-headline">Forgot Password</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner section ends -->
    <div class="main">
        <div class="form-wrapper">
            <div class="signin-image">
                <img src="frontend/images/auth/forgotpass.png" alt="signin image" class="img-fluid" />
            </div>
            <div class="form-container">
                <div class="center">
                    <h4>Forgot Password</h4>
                    <p class="mt_16">
                        Enter your email for the verification process, <br />
                        we will send code to your email
                    </p>
                </div>
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Forgot Password --}}
                <form class="signin-form" method="POST" action="{{ route('otp.request') }}">
                    @csrf
                    <div>
                        <input type="email" name="email" placeholder="Email Address" class="inputfield"
                            value="{{ old('email') }}" required autofocus />
                    </div>

                    <!-- Error handling -->
                    @if ($errors->has('email'))
                        <div class="mt-2 text-red-600 text-sm">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <div class="signinBtn-wrapper mt_16">
                        <button class="signinBtn center" type="submit">Continue</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

