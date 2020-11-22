@component('mail::message')
# Welcome to e-DM5 Blast

Please Activate your account by paying the fee of 10 USD to our account.
<br>
Payments are required to be made using either Merchantrade Account or USDT.
<br>
Our policy is that a fixed currecny exchange rate of  <br>
RM 5.00 = 1.00 USD

@component('mail::button', ['url' => 'https://www.e-dm5.uk/Members/'])
Login to e-DM5 
@endcomponent

Thanks,<br>
{{ config('app.name') }} Administrator
@endcomponent
