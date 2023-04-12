@extends('layouts.app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-6 offset-lg-3">
            <h1>ページが見つかりませんでした。</h1>
            <p>お探しのページは削除されたか、URLが変更された可能性があります。</p>
            <a href="{{ route('top') }}">
                <button type="button" class="btn btn-sm btn-secondary">トップページへ</button>
            </a>
        </div>
    </div>
@endsection
