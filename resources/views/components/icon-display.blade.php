{{-- イイコトを評価している場合、アイコンの数で表示する --}}
@empty(!$thing->good_thing_order)
    <div class="thing-good-icon">
        @for ($i = 0; $i < $thing->good_thing_order; $i++)
            <span>
                <img src="{{ asset('images/icons/good_icon.svg') }}">
            </span>
        @endfor
    </div>
@endempty
{{-- ヤナコトを評価している場合、アイコンの数で表示する --}}
@empty(!$thing->bad_thing_order)
    <div class="thing-bad-icon">
        @for ($i = 0; $i < $thing->bad_thing_order; $i++)
            <span>
                <img src="{{ asset('images/icons/bad_icon.svg') }}">
            </span>
        @endfor
    </div>
@endempty
