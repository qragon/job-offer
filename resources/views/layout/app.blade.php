<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite('resources/assets/js/app.js')
</head>
<body>
@include('layout.component.header.header')
@yield('content')
@include('layout.component.footer.footer')
</body>
</html>
