@component('mail::message')
# Account is activated

Congratulations your account is activated.<BR>
You may now select a plan and make payment to start enjoying the benefits of e-DM5 Blast.
<br>
Proceed to your e-DM5 accoutn and select a plan that suits your needs.
<br>
Payments are required to be made using either Merchantrade Account or USDT.
<br>
Our policy is that a fixed currecny exchange rate of  <br>
RM 5.00 = 1.00 USD
<br>
(USDT Payments may differ due to currency rate)

@component('mail::button', ['url' => 'https://www.e-dm5.uk/Members/'])
Login to e-DM5 
@endcomponent

Thanks,<br>
{{ config('app.name') }} Administrator
@endcomponent
