<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <title>Orders PDF</title>
</head>
<body>
    <h4>Détails de la commande : <b>{{ $order->number }}</b></h4>
    <table class="table table-bordered">
        <tr>
            <th>Numéro</th>
            <td class="text-bold">{{$order->number}}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>{{$formatter->formatCurrency($order->total, env('CURRENCY_CODE'))}}</td>
        </tr>
        <tr>
            <th>Frais de livraison</th>
            <td>{{$formatter->formatCurrency($order->shipping->fee, env('CURRENCY_CODE'))}}</td>
        </tr>

        <tr>
            <th>Réduction 
                @if(isset($invoice->order->coupon_data['discount_type']) && $invoice->order->coupon_data['discount_type'] == 'percent')
                    {{ '( '.$invoice->order->coupon_data['discount_percent'].'% )' }}
                @endif
            </th>
            <td>{{$formatter->formatCurrency($order->reduction, env('CURRENCY_CODE'))}}</td>
        </tr>
        <tr>
            <th>Total à payer</th>
            <td>{{$formatter->formatCurrency($order->total_to_pay, env('CURRENCY_CODE'))}}</td>
        </tr>
        <tr>
            <th>Nom et prenom</th>
            <td>{{$order->user->first_name .'  '.$order->user->last_name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$order->user->email}}</td>
        </tr>
        <tr>
            <th>Créer le</th>
            <td>{{$order->created_at->format('d/m/Y H:i')}}</td>
        </tr>
        <tr>
            <th>Etat</th>
            <td>
                @switch($order->state)
                    @case('canceled')
                        <span class="label label-danger">{{$order->state}}</span>
                        @break
                    @case('waiting')
                        <span class="label label-warning">{{$order->state}}</span>
                        @break
                    @default
                    <span class="label label-success">{{$order->state}}</span>
                @endswitch
            </td>
        </tr>
        <tr>
            <th>Commentaire</th>
            <td>{{$order->comment}}</td>
        </tr>
    </table>
    <h4>Détails de la commande</h4>
    <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nom</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->orderLines as $line)
                <tr>
                    <td>{{ $line->model->name }}</td>
                    <td>{{ $line->quantity }}</td>
                    <td>{{ $line->model->price }}</td>
                    <td>{{ $line->subtotal }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
</body>
</html>