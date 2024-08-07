<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Inclusão do Bootstrap via Vite--}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Celke</title>
</head>
<body class="bg-primary">

    @yield('content')

</body>
</html>
