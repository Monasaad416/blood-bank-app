@component('mail::message')
# Introduction

Blood Bank App Reset Password.
you pincode in {{$pinCode}}.

@component('mail::button', ['url' => 'client.password.reset'])
Create New Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
