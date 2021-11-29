@component('mail::message')
Dear user,<br>
A new post was added to <strong>{{ $website }}</strong> you subscribed to.

## See the post below.

@component('mail::panel')
# {{ $title }}<br>
## {{ $description }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
