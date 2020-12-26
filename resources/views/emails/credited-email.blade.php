@component('mail::message')
# Account is now live with a plan

Congratulations your account is ready to go.<br>

View your statistics on the dashboard by loggin in to the system.

@component('mail::button', ['url' => 'https://www.e-dm5.uk/Members/'])
Login to e-DM5 Dashboard
@endcomponent


Your e-DM5 Market Account will be created soon and you may use the credentials to access your account.

Username for login is your EDM5 Blast Account.
First Time Password is your email address, it is recommended to change the password immediately after logging in .


@component('mail::button', ['url' => 'https://shop.e-dm5.uk/wp/my-account-2/'])
Login to e-DM5 Market Account
@endcomponent





Thanks,<br>
{{ config('app.name') }} Administrator
@endcomponent
