@component('mail::message')
# Congratulations!

Dear {{ $contactUs->name }},

We are pleased to inform you that you are qualified to join our company.

Thank you for your interest, and we look forward to working with you.

Best regards, Sto Domingo Associates
{{-- {{ config('app.name') }} --}}

@endcomponent
