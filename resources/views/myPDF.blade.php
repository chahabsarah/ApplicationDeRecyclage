<!DOCTYPE html>
<html>
<head>
    <title>Recycling centers - PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        img {
            max-width: 100px; /* Ajuster la taille maximale de l'image */
            height: auto;
        }
    </style>
</head>
<body>

    <h1>Recycling Centers</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Website</th>
                <th>Waste Type</th>
                <th>Logo</th> <!-- Nouvelle colonne pour afficher le logo -->
            </tr>
        </thead>
        <tbody>
            @foreach($centres as $centre)
                <tr>
                    <td>{{ $centre->nom }}</td>
                    <td>{{ $centre->localisation }}</td>
                    <td>{{ $centre->numero_telephone }}</td>
                    <td>{{ $centre->email }}</td>
                    <td>{{ $centre->site_web }}</td>
                    <td>
    @if($centre->type_dechet)
        <ul>
            @php
                // Vérifie si c'est un tableau ou une chaîne JSON
                $dechets = is_array($centre->type_dechet) ? $centre->type_dechet : json_decode($centre->type_dechet, true);

                // Si json_decode échoue, utilisez un tableau vide
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $dechets = [];
                }
            @endphp

            @foreach($dechets as $dechet)
                <li>{{ htmlspecialchars($dechet, ENT_QUOTES, 'UTF-8') }}</li>
            @endforeach
        </ul>
    @else
        N/A
    @endif
</td>
                    <td>
                        @if($centre->logo)
                            <img src="{{ public_path('storage/' . $centre->logo) }}" alt="Logo">
                        @else
                            N/A <!-- Si aucun logo n'est disponible -->
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
