@component('mail::message')
<!-- # Employee Registration Notification -->

Good day {{ $tenant_first_name }}  {{ $tenant_last_name }},

A new employee registered for {{ $company_name }} :

{{ $first_name }} {{ $last_name }}

@component('mail::button', ['url' => $tenant_domain_url, 'color' => 'success'])
Click here to approve/decline
@endcomponent

<br>
Best Regards,<br>
ARRAY
@endcomponent
