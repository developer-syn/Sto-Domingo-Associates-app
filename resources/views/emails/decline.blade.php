@component('mail::message')
# Thank you for your interest

Dear {{ $contactUs->name }},

We regret to inform you that you are not qualified to join our company at this time.

We wish you all the best in your future endeavors.

Best regards,
{{ config('app.name') }}

@endcomponent
