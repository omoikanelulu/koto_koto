@props(['thing'])

@empty(!$thing->bad_thing_workaround)
    <p class="bad-thing-workaround p-3 rounded-3">
        {!! nl2br(e($thing->bad_thing_workaround), false) !!}
    </p>
@endempty
