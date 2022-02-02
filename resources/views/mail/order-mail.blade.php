@component('mail::message')
# Invoice No : {{$order['invoice_number']}}

## Name : {{$order['name']}}<br>
## Enail : {{$order['email']}}
@component('mail::table')
    | Amount  | Shipping cost  | Total amount  |
    |:--------:|:--------------:|:-------------:|
    | {{$order['amountbefore']}}EGP | {{$order['cost']}}EGP | {{$order['amount']}}EGP |
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
