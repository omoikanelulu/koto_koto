{{-- @props(['thing'])

@empty(!$thing->bad_thing_workaround)
    <div class="bad-thing-workaround p-3 rounded-3">
        {!! nl2br(e($thing->bad_thing_workaround), false) !!}
    </div> --}}
{{-- @endempty --}}

@props(['thing'])

@empty(!$thing->bad_thing_workaround)
    <tr class="d-flex justify-content-end">
        <td class="bad-thing-workaround p-3 rounded-3">
            {!! nl2br(e($thing->bad_thing_workaround), false) !!}
        </td>
    </tr>
@endempty

{{-- @props(['thing'])

@empty(!$thing->bad_thing_workaround)
    <tr>
        <td class="bad-thing-workaround p-3 rounded-3 text-end">
            {!! nl2br(e($thing->bad_thing_workaround), false) !!}
        </td>
    </tr>
@endempty --}}
