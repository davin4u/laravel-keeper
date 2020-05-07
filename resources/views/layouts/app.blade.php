<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel keeper') }}</title>

    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => new \App\Http\Resources\UserResource(Auth::user())
        ]) !!};

    </script>
</head>
<body class="bg-gray-200">
    <div id="app">
        <div class="w-full app-full-height">
            @yield('content')
        </div>
    </div>

    <script src="/js/app.js"></script>
</body>
</html>
