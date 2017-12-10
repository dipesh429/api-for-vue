@component('mail::message')
# Welcome {{$user->name}}

Thank you for creating an account. Please click in the following link 

@component('mail::button', ['url' => route('verify',$user->verification_token)])

Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
