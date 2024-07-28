{{-- Mensagens de sucesso --}}
@if (session('success'))
    <p style="background-color: green; color: white">
        {{ session('success') }}
    </p>
@endif

{{-- Mensagens de error --}}
@if (session('error'))
    <p style="background-color: red; color: white">
        {{ session('error') }}
    </p>
@endif


{{-- Mensagens de errors de validação --}}
@if ($errors->any())
    <span style="background-color: red; color: white">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </span>
@endif


