@extends('layouts.login')
@section('content')
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Área Restrita</h3>
                                </div>
                                <div class="card-body">

                                    <x-alert />

                                    <form action="{{ route('login.process') }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="E-mail do usuário" value="{{ old('email') }}">
                                            <label for="email">E-mail</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Senha">
                                            <label for="password">Password</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a href="#" class="small text-decoration-none">Esqueceu a senha?</a>
                                            <button type="submit" class="btn btn-primary">Acessar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small">
                                        Precisa de uma conta?
                                        <a href="#" class="text-decoration-none">Inscrever-se!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
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
@endsection
