@extends('layouts.app')

@section('content')
    <div class="row g-3">
        <div class="col-lg-6 offset-lg-3">
            <h1>このページは参照出来ません。</h1>
            <p>お探しのページは参照出来ないようになっています。</p>
            <a href="{{ route('top') }}">
                <button type="button" class="btn btn-sm btn-secondary">トップページへ</button>
            </a>
        </div>
    </div>
@endsection
