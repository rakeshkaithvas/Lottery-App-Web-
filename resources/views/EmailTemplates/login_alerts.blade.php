@component('mail::message')
# Dear Users,
**We detected a login attempt from an unrecognised device.**<br>
This could have been an attempt at fraud. To keep your account secure, we need to confirm if it was you.

@component('mail::panel')
# Was this you?

- IP Address<br>
**{{ $location->ip ?? 'No Data' }}**
- City<br>
**{{ $location->cityName ?? 'No Data' }}**
- Zip Code<br>
**{{ $location->zipCode ?? 'No Data' }}**
- Region<br>
**{{ $location->regionName ?? 'No Data' }}**
- Country<br>
{{-- **{{ $location->location->country ?? 'NULL Country'}}** --}}
- Latitude<br>
**{{ $location->latitude ?? 'No Data' }}**
- Longitude<br>
**{{ $location->longitude ?? 'No Data' }}**
- Currency Code<br>
**{{ $location->currencyCode ?? 'No Data' }}**
- TimeZone<br>
**{{ $location->timezone ?? 'No Data' }}**
@endcomponent

Please review this activity and ensure it was you. If not, take necessary actions to secure your account or <a href="mailto:{{ config('app.support_email') }}">contact us</a> immediately.

Thanks,<br>
Team {{ config('app.name') }}
@endcomponent
