<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel keeper') }}</title>

        <!-- Custom Theme Style -->
        <link href="/css/app.css" rel="stylesheet">
        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>

    <body class="bg-blue-600">
        <div id="app">
            <div class="w-full">
                <div class="w-1/3 mx-auto">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
