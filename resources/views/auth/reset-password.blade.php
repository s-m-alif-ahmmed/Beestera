@extends('frontend.app')
@section('title', 'Reset Password')
@section('content')
    <!-- Main Area Starts -->
    <!-- Banner section starts -->
    <section>
        <div>
            <div class="auth-banner-image">
                <div class="banner-text-wrapper text-center" data-aos="zoom-out" data-aos-duration="800">
                    <h1 class="fw-700 banner-headline">Reset Password</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner section ends -->
    <div class="main">
        <div class="form-wrapper">
            <div class="signin-image">
                <img src="{{ asset('frontend/images/auth/cuate.png') }}" alt="signin image" class="img-fluid" />
            </div>
            <div class="form-container">
                <div class="center">
                    <h4>Reset Password</h4>
                </div>
                <form class="signin-form" method="POST" action="{{ route('password.store') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div>
                        <input type="email" name="email" placeholder="Email Address" class="inputfield"
                            value="{{ old('email', $request->email) }}" required autofocus />
                    </div>

                    <div class="pass-container">
                        <input id="passwordInput" type="password" name="password" placeholder="New Password"
                            class="inputfield" required autocomplete="new-password" />
                        <span class="authicon"
                            onclick="togglePasswordVisibility('passwordInput', 'authIconHide', 'authIconShow')">
                            <img id="authIconHide" src="{{ asset('frontend/images/icons/sm-icons/PassShowIcon.svg') }}"
                                alt="Hide icon" class="hiddenicon" />
                            <img id="authIconShow" src="{{ asset('frontend/images/icons/sm-icons/PassShowIcon.svg') }}"
                                alt="Show icon" class="seenicon" style="display: none" />
                        </span>
                    </div>

                    <div class="pass-container">
                        <input id="passwordInput2" type="password" name="password_confirmation"
                            placeholder="Re-enter Password" class="inputfield" required autocomplete="new-password" />
                        <span class="authicon2"
                            onclick="togglePasswordVisibility('passwordInput2', 'authIconHide2', 'authIconShow2')">
                            <img id="authIconHide2" src="{{ asset('frontend/images/icons/sm-icons/PassShowIcon.svg') }}"
                                alt="Hide icon" class="hiddenicon" />
                            <img id="authIconShow2" src="{{ asset('frontend/images/icons/sm-icons/PassShowIcon.svg') }}"
                                alt="Show icon" class="seenicon" style="display: none" />
                        </span>
                    </div>

                    <div class="signinBtn-wrapper">
                        <button class="signinBtn" type="submit">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection
