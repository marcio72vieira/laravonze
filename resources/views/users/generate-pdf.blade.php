<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <title>Usuários</title>
</head>
<body style="font-size: 12px">
        <h2 style="text-align: center">Lista de Usuários</h2>
        <table style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr style="background-color: #adb5bd">
                    <th style="border: 1px solid #ccc; text-align: center">Id</th>
                    <th style="border: 1px solid #ccc; text-align: center">Nome</th>
                    <th style="border: 1px solid #ccc; text-align: center">E-mail</th>
                    <th style="border: 1px solid #ccc; text-align: center">Papel</th>
                    <th style="border: 1px solid #ccc; text-align: center">Cadastrado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td style="border: 1px solid #ccc;">{{ $user->id }}</td>
                        <td style="border: 1px solid #ccc;">{{ $user->name }}</td>
                        <td style="border: 1px solid #ccc;">{{ $user->email }}</td>
                        <td style="border: 1px solid #ccc;">
                            @forelse ($user->getRoleNames() as $role)
                                {{ $role }}
                            @empty
                                {{ " - " }}
                            @endforelse
                        </td>
                        <td style="border: 1px solid #ccc; text-align: center">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="border: 1px solid #ccc; text-align: center; color: rgb(244, 111, 111);">Nenhum usuário encontrado!</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
</body>
</html>
