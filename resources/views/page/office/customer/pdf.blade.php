<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Report Customer</title>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
</head>

<body>
    <center>
        <h3>Report Customer</h3>
    </center>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $i => $customer)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->address}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
