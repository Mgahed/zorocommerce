@component('mail::message')
# {{$order['name']}}

## {{$order['msg']}}

{{$order['invoice']}}


{{--@component('mail::button', ['url' => ''])
Button Text
@endcomponent--}}

{{__('Thanks,')}}<br>
{{ config('app.name') }}
@endcomponent
