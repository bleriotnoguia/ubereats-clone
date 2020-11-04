<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <title>Transactions PDF</title>
</head>
<body>
    <h4>Transaction ID : <b>{{ $transaction->hash }}</b></h4>
    <table class="table table-bordered">
        <tr>
            <th>Date</th>
            <td class="text-bold">{{$transaction->created_at}}</td>
        </tr>
        <tr>
            <th>Transaction type</th>
            <td>{{ $transaction->type }}</td>
        </tr>
        <tr>
            <th>Net payout</th>
            <td>{{$formatter->formatCurrency($transaction->amount, env('CURRENCY_CODE'))}}</td>
        </tr>
</body>
</html>