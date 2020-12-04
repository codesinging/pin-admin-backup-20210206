<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', admin_config('name'))</title>
    <link rel="stylesheet" href="{{ admin_mix('app.css') }}">
    @yield('style')
    <script>
        let adminCsrfToken = '{{ csrf_token() }}';
        let adminBaseUrl = '';
    </script>
    @yield('header')
</head>
<body>
<script src="{{ admin_mix('app.js') }}"></script>
@yield('content')
@yield('footer')
</body>
</html>