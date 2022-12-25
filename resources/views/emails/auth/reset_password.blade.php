@component('mail::message')
# Introduction

Blood Bank App Reset Password.
you pincode in {{$pinCode}}.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
