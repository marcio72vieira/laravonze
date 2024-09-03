<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- VIA CDN <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    {{-- VIA INCLUSÃO DIRETA DOS ARQUIVOS NA PASTA PUBLIC <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    {{-- sbadmin--}}
    {{-- VIA INCLUSÃO DIRETA DOS ARQUIVOS NA PASTA PUBLIC <link href="{{ asset('css/styles_sbadmin.css') }}" rel="stylesheet"> --}}
    {{-- style prsonalizado mrc--}}
    {{-- VIA INCLUSÃO DIRETA DOS ARQUIVOS NA PASTA PUBLIC <link href="{{ asset('css/stylesmrc_admin.css') }}" rel="stylesheet"> --}}
    {{-- fontawesome --}}
    {{-- VIA INCLUSÃO DIRETA DOS ARQUIVOS NA PASTA PUBLIC <link href="{{ asset('css/all.min.css') }}" rel="stylesheet"> --}}

    {{-- Inclusão do Bootstrap via Vite--}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Celke</title>
</head>
<body class="sb-nav-fixed">

    {{-- sbadmin--}}
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-nav-mrc">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="order-1 btn btn-link btn-sm order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="my-2 d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.show') }}">Perfil</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="{{ route('login.destroy') }}">Sair</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-five" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a @class(['nav-link', 'active' => isset($menu) && $menu == 'dashboard']) href="{{ route('dashboard.index')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        @can('index-user')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'users']) href="{{ route('user.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Usuários
                            </a>
                        @endcan

                        @can('index-course')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'courses']) href="{{ route('course.index') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                                Cursos
                            </a>
                        @endcan

                        @can('index-role')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'roles']) href="{{ route('role.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-network-wired"></i></div>
                                Papéis
                            </a>
                        @endcan

                        @can('index-permission')
                            <a @class(['nav-link', 'active' => isset($menu) && $menu == 'permissions']) href="{{ route('permission.index') }}">
                                <div class="sb-nav-link-icon"><i class="fa-regular fa-file"></i></div>
                                Permissões
                            </a>
                        @endcan

                        <a class="nav-link" href="{{ route('login.destroy') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                            Sair
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged:
                        {{-- Se houver um usuário logado, imprimir o nome do usuário --}}
                        @if (auth()->check())
                            {{ auth()->user()->name;}}
                        @endif
                        @forelse (Auth::user()->getRoleNames() as $role)
                            ({{ $role }})
                            @empty
                                {{ " - " }}
                            @endforelse
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>

            <footer class="py-4 mt-auto bg-light">
                <div class="px-4 container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; MarcioVieira {{ date('Y') }}</div>
                        <div>
                            <a href="#" class="text-decoration-none">Privacy Policy</a>
                            &middot;
                            <a href="#" class="text-decoration-none">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>



    {{-- VIA CDN <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    {{-- VIA INCLUSÃO DIRETA DOS ARQUIVOS NA PASTA PUBLIC <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- sbadmin--}}
    {{-- VIA INCLUSÃO DIRETA DOS ARQUIVOS NA PASTA PUBLIC <script src="{{ asset('js/scripts_sbadmin.js') }}"></script> --}}
    {{-- fontawesome --}}
    {{-- via cdn <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> --}}
    {{-- VIA INCLUSÃO DIRETA DOS ARQUIVOS NA PASTA PUBLIC <script src="{{ asset('js/all.min.js') }}"></script> --}}

</body>
</html>
