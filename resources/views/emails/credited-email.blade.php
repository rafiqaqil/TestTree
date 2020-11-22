@component('mail::message')
# Account is now live with a plan

Congratulations your account is ready to go.<br>

View your statistics on the dashboard by loggin in to the system.

@component('mail::button', ['url' => 'https://www.e-dm5.uk/Members/'])
Login to e-DM5 
@endcomponent

Thanks,<br>
{{ config('app.name') }} Administrator
@endcomponent
