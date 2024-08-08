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
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">

                        @yield('content')

                    </div>
                </div>
            </main>
        </div>

        {{-- footer --}}
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website {{ date('Y')}}</div>
                        <div>
                            {{--
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                            --}}
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
