
<div class="content">
    <p> {!!$data['content']!!} </p>
</div>
@php
    $tracker = $data['tracker'];
@endphp

<div style="text-align: center">
    <a href="{{ $data['unsubscribe_link']}}"
       target="_blank"
       style="text-decoration: none;">unsubscribe</a>
</div>
<img src="{{ route('tracker.emails.store') }}/?tracker={{$tracker->tracker}}&email_id={{$tracker->subscriber_id}}&campaign_id={{$tracker->campaign_id}}&record=OPENED" width="1" height="1">
