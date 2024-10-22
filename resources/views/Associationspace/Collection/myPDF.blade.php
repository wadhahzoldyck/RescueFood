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
                <th>ID</th>
                <th>Collection Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($collections as $collection)
            <tr>
                <td>{{ $collection->id }}</td>
                <td>{{ $collection->dateCollecte }}</td>
                <td>{{ $collection->etat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
