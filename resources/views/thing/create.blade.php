@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('thing.store') }}" method="post">
        @csrf
        <div class="col-lg-6 offset-lg-3">
            <label for="thing" class="form-label">デキゴト</label>
            <textarea class="form-control @error('thing') is-invalid @enderror" aria-describedby="validate" name="thing"
                id="thing" cols="30" rows="5" wrap="hard" placeholder="デキゴトを入力">{{ old('thing') }}</textarea>
            @error('thing')
                <div class="invalid-feedback" id="validate">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-lg-6 offset-lg-3">
            <label for="bad_thing_workaround" class="form-label">タイサク</label>
            <textarea class="form-control @error('bad_thing_workaround') is-invalid @enderror" aria-describedby="validate"
                name="bad_thing_workaround" id="bad_thing_workaround" cols="30" rows="10" wrap="hard" placeholder="タイサクを入力">{{ old('bad_thing_workaround') }}</textarea>
            @error('bad_thing_workaround')
                <div class="invalid-feedback" id="validate">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-lg-6 offset-lg-3">
            <label for="">イイコト評価</label>
            <div class="form-check">
                <input class="form-check-input @error('good_thing_order') is-invalid @enderror" aria-describedby="validate"
                    type="radio" name="good_thing_order" id="good_thing_order_0" value="0" checked>
                <label class="form-check-label" for="good_thing_order_0">なし</label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('good_thing_order') is-invalid @enderror" aria-describedby="validate"
                    type="radio" name="good_thing_order" id="good_thing_order_1" value="3">
                <label class="form-check-label" for="good_thing_order_1">すごくイイ</label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('good_thing_order') is-invalid @enderror" aria-describedby="validate"
                    type="radio" name="good_thing_order" id="good_thing_order_2" value="2">
                <label class="form-check-label" for="good_thing_order_2">イイ</label>
            </div>
            <div class="form-check">
                <input class="form-check-input @error('good_thing_order') is-invalid @enderror" aria-describedby="validate"
                    type="radio" name="good_thing_order" id="good_thing_order_3" value="1">
                <label class="form-check-label" for="good_thing_order_3">ちょっとイイ</label>
            </div>
            @error('good_thing_order')
                {{-- 何故だか上手く表示されないので、手動でstyleを指定 --}}
                <div class="invalid-feedback" aria-describedby="validate" style="display: block;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-lg-6 offset-lg-3">
            <label for="">ヤナコト評価</label>
            <div class="form-check form-check">
                <input class="form-check-input @error('bad_thing_order') is-invalid @enderror" type="radio"
                    name="bad_thing_order" id="bad_thing_order_0" value="0" checked>
                <label class="form-check-label" for="bad_thing_order_0">なし</label>
            </div>
            <div class="form-check form-check">
                <input class="form-check-input @error('bad_thing_order') is-invalid @enderror" type="radio"
                    name="bad_thing_order" id="bad_thing_order_1" value="3">
                <label class="form-check-label" for="bad_thing_order_1">すごくイヤ</label>
            </div>
            <div class="form-check form-check">
                <input class="form-check-input @error('bad_thing_order') is-invalid @enderror" type="radio"
                    name="bad_thing_order" id="bad_thing_order_2" value="2">
                <label class="form-check-label" for="bad_thing_order_2">イヤ</label>
            </div>
            <div class="form-check form-check">
                <input class="form-check-input @error('bad_thing_order') is-invalid @enderror" type="radio"
                    name="bad_thing_order" id="bad_thing_order_3" value="1">
                <label class="form-check-label" for="bad_thing_order_3">ちょっとイヤ</label>
            </div>
            @error('bad_thing_order')
                {{-- 何故だか上手く表示されないので、手動でstyleを指定 --}}
                <div class="invalid-feedback" aria-describedby="validate" style="display: block;">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="col-lg-6 offset-lg-3">
            <button type="submit" class="btn btn-sm btn-primary">記録する</button>
            <a href="{{ route('thing.index') }}">
                <button type="button" class="btn btn-sm btn-secondary">戻る</button>
            </a>
        </div>
    </form>
@endsection
