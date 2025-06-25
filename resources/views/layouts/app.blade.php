<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @php
        use App\Constants\GeneralConst;
    @endphp
    <title>{{ GeneralConst::APP_NAME }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="favicon" href="/favicon.ico" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="googlebot" content="noindex">
    <meta name="robots" content="noindex">

    <!-- Styles -->
    @include('includes.common.style')
</head>

<body>
    <!-- headerー-->
    @include('includes.common.header')
    <!-- content -->
    <main id="main">
        <div class="container-xxl flex-grow-1 ">
            @yield('content')
        </div>
    </main>
    <!-- footer -->
    @include('includes.common.footer')
    <!-- modal -->
    @yield('page_modal')
    <!-- scripts-->
    @include('includes.common.script')
    @section('script')

    @show
</body>

</html>
