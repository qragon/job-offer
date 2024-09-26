<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    @vite('resources/assets/js/app.js')
</head>
<body>
@include('layout.component.header.header')
<main>@yield('content')</main>
@include('layout.component.footer.footer')
</body>
</html>
