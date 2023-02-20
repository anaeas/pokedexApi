<!DOCTYPE html>
<html>
<head>
    <title>Pokémons</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Pokémons</h1>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Habilidade 1</th>
                <th>Habilidade 2</th>
                <th>Habilidade 3</th>
                <th>Imagem</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pokemons as $pokemon)
            <tr>
                <td>{{ $pokemon['nome'] }}</td>
                <td>{{ $pokemon['tipo'] }}</td>
                <td>{{ $pokemon['habilidade_1'] }}</td>
                <td>{{ $pokemon['habilidade_2'] }}</td>
                <td>{{ $pokemon['habilidade_3'] }}</td>
                <td><img src="{{ $pokemon['image'] }}" alt="{{ $pokemon['nome'] }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
