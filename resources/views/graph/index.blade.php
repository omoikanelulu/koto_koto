@extends('layouts.app')

@section('content')
    <h1>期間を指定してグラフを表示</h1>
    <form action="{{ route('graph.show_chart') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <label class="input-group-text" for="start_date">開始日:</label>
            <input class="form-control" type="date" name="start_date" id="start_date" required>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="end_date">終了日:</label>
            <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $today }}" required>
        </div>
        <button class="btn btn-sm btn-primary" type="submit">グラフ化する</button>
    </form>
@endsection
