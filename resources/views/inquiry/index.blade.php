@extends('layouts.app')

@section('content')
    <div class="col-lg-10 offset-lg-1 mb-5">
        <h2>お問い合わせ一覧</h2>
    </div>
    @foreach ($inquiries as $inquiry)
        <div class="mb-5">
            <div class="col-lg-10 offset-lg-1">
                <p>お問い合わせID : {{ $inquiry->id }}</p>
            </div>
            <div class="col-lg-10 offset-lg-1">
                <p>氏名 : {{ $inquiry->name }}</p>
            </div>
            <div class="col-lg-10 offset-lg-1">
                <p>メールアドレス : {{ $inquiry->email }}</p>
            </div>
            <div class="col-lg-10 offset-lg-1">
                <p for="inquiry">お問い合わせ内容 : </p>
                <textarea class="form-control" name="inquiry" id="inquiry" cols="30" rows="5" wrap="hard" disabled>{{ $inquiry->inquiry }}</textarea>
            </div>
        </div>
    @endforeach

    {{-- 戻るボタン --}}
    <div class="col-lg-10 offset-lg-1">
        <a href="{{ route('thing.index') }}">
            <button type="button" class="btn btn-sm btn-secondary">戻る</button>
        </a>
    </div>
@endsection
