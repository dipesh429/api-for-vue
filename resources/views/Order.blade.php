@component('mail::message')
# Welcome {{$user->name}}

Your food ({{$user->waste}}) has been bought. 
<br>
Quantity Bought = {{$user->quantity}}

<br>

Please Contact Us 

Thanks,<br>
{{ config('app.name') }}
@endcomponent
