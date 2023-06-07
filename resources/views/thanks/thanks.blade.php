<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="col-lg-6 offset-lg-3 text-center p-5">
                    <h3>ご利用ありがとうございました</h3>
                    <a class="btn btn-primary m-5" href="{{ route('top') }}">トップページへ</a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
