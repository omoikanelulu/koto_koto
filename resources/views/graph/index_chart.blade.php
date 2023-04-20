@extends('layouts.app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-6 offset-lg-3">
            <h1>{!! $const['title'] !!}</h1>
            <form action="{{ route('graph.show_chart') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <label class="input-group-text" for="start_date">開始日:</label>
                    <input class="form-control" type="date" name="start_date" id="start_date" value="{{ $first_day_of_year }}"
                        required>
                </div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="end_date">終了日:</label>
                    <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $today }}"
                        required>
                </div>
                <button class="btn btn-sm btn-primary" type="submit">{!! $const['submit'] !!}</button>
                <a href="{{ route('thing.index') }}">
                    <button type="button" class="btn btn-sm btn-secondary">戻る</button>
                </a>

            </form>
        </div>
    </div>
@endsection
