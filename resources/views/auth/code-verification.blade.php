@extends('frontend.app')
@section('title', 'Code Verification')
@section('content')
    <!-- Banner section starts -->
    <section>
        <div>
            <div class="auth-banner-image">
                <div class="banner-text-wrapper text-center" data-aos="zoom-out" data-aos-duration="800">
                    <h1 class="fw-700 banner-headline">Varification</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner section ends -->
    <div class="main">
        <div class="form-wrapper">
            <div class="signin-image">
                <img src="\frontend\images\auth\forgotpass.png" alt="signin image" class="img-fluid" />
            </div>
            <div class="form-container">
                <div class="center">
                    <h3>Enter 4 digit code</h3>
                    <p class="mt_16">
                        A four-digit code should have come to your <br />
                        email address that you indicated.
                    </p>
                </div>
                <form class="verification" method="POST" action="{{ route('otp.verify') }}"> <!-- Set the correct route -->
                    @csrf <!-- Include CSRF token for security -->

                    <div class="signin-form">
                        <input type="number" name="otp" placeholder="Enter Code" class="inputfield" required
                            maxlength="4" oninput="this.value = this.value.slice(0, 4)" />
                    </div>
                    <div class="signinBtn-wrapper mt_16">
                        <button class="signinBtn" type="submit">
                            Confirm
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
