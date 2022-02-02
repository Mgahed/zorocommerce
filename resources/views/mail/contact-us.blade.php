@component('mail::message')
# From Contact US
## From {{$email_data['email']}}
### Name {{$email_data['name']}}

{!! $email_data['msg'] !!}

{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}

{{--<br>--}}
{{--{{ config('app.name') }}--}}
@endcomponent
