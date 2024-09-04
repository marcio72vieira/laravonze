{{-- Mensagens de sucesso --}}
@if (session('success'))
    {{-- Alert do bootstrap
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Ok!",
                html: '{{ session('success') }}',
                icon: 'success'
            });
        })
    </script>
@endif

{{-- Mensagens de aviso --}}
@if (session('warning'))
    {{-- Alert do bootstrap
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Aviso!",
                html: '{{ session('warning') }}',
                icon: 'warning'
            });
        })
    </script>
@endif

{{-- Mensagens de error --}}
@if (session('error'))
    {{-- Alert do bootstrap
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Error!",
                html: '{{ session('error') }}',
                icon: 'error'
            });
        })
    </script>
@endif


{{-- Mensagens de errors de validação --}}
@if ($errors->any())
        {{-- Alert do bootstrap
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        --}}

        @php
            $message = '';
            foreach ($errors->all() as $error) {
                $message .= $error.'<br>';
            }
        @endphp

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: "Error!",
                    html: '{!! $message !!}',
                    icon: 'error'
                });
            })
        </script>

@endif


