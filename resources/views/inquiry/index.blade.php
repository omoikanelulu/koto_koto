@extends('layouts.app')

@section('content')
<h2>ここにお問い合わせ一覧を表示する</h2>
    <form class="row g-3" action="{{ route('inquiry.store') }}" method="post">
        @csrf

        <div class="col-lg-6 offset-lg-3">
            <label for="name" class="form-label">氏名</label>
            <input class="form-control @error('name') is-invalid @enderror" aria-describedby="validateName" name="name"
                id="name" placeholder="氏名を入力">{{ old('name', $inquiry->name ?? '') }}
            </input>
            @error('name')
                <div class="invalid-feedback" id="validateName">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-lg-6 offset-lg-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input class="form-control @error('email') is-invalid @enderror" aria-describedby="validateEmail" name="email"
                id="email" placeholder="メールアドレスを入力">{{ old('email', $inquiry->email ?? '') }}
            </input>
            @error('email')
                <div class="invalid-feedback" id="validateEmail">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-lg-6 offset-lg-3">
            <label for="inquiry" class="form-label">お問い合わせ内容</label>
            <textarea class="form-control @error('inquiry') is-invalid @enderror" aria-describedby="validateInquiry" name="inquiry"
                id="inquiry" cols="30" rows="10" wrap="hard" placeholder="お問い合わせ内容を入力">{{ old('inquiry', $inquiry->inquiry ?? '') }}</textarea>
            @error('inquiry')
                <div class="invalid-feedback" id="validateInquiry">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-lg-6 offset-lg-3">
            <button type="submit" class="btn btn-sm btn-primary">送信する</button>
            <a href="{{ route('thing.index') }}">
                <button type="button" class="btn btn-sm btn-secondary">戻る</button>
            </a>
        </div>
    </form>
@endsection
