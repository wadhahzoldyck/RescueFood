<!DOCTYPE html>
<html>
<head>
    <title>User Collections Report - PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Date: {{ $date }}</p>
    <p>Below is a list of collections made by the user.</p>
  
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Collection Date</th>
                <th>Status</th>
                <th>Dons Associés</th>

            </tr>
        </thead>
        <tbody>
            @foreach($collections as $collection)
            <tr>
                <td>{{ $collection->titre }}</td>
                <td>{{ $collection->dateCollecte }}</td>
                <td>{{ $collection->etat }}</td>
                <ul>
                    @foreach ($collection->listeDons as $don)
                        <li>{{ $don->nourriture->nom }} - {{ $don->quantité }}</li>
                    @endforeach
                </ul>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
