<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beestera</title>
    @if (!empty($systemSetting->favicon))
        <link rel="icon" type="image/x-icon" href="{{ $systemSetting->favicon ?? ' ' }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('backend/images/logo.png') }}">
    @endif
    @include('frontend.partials.styles')
</head>

<body>
    @include('frontend.partials.header')
    @include('frontend.partials.sidebar')

    <main>
        @yield('content')
    </main>
    @include('frontend.partials.footer')
    @include('frontend.partials.scripts')
</body>


</html>
