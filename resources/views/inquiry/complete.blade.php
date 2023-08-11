@extends('layouts.app')

@section('content')
    <div class="col-lg-6 offset-lg-3">
        @if (session('message'))
            <div class="alert alert-success text-center">
                <h2>{{ session('message') }}</h2>
            </div>
        @endif

        <p class="fw-bold">氏名</p>
        <p>{{ $inquiry->name ?? '' }}</p>

        <p class="fw-bold">メールアドレス</p>
        <p>{{ $inquiry->email ?? '' }}</p>

        <p class="fw-bold">お問い合わせ内容</p>
        <p>{!! nl2br(e($inquiry->inquiry ?? '')) !!}</p>
    </div>
    <div class="col-lg-6 offset-lg-3">
        <a href="{{ route('top') }}">
            <button type="button" class="btn btn-sm btn-secondary">戻る</button>
        </a>
    </div>
@endsection
