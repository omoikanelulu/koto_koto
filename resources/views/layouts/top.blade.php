@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card col-lg-12 px-0">
            <div class="card-header">
                <h2>{{ config('app.name', 'Laravel') }}</h2>
            </div>
            <div class="card-body">
                <h4 class="card-title">{{ config('app.name', 'Laravel') }}とは？</h4>
                <p class="card-text ms-3">
                    {!! App\consts\MessageConst::INTRODUCTION !!}
                </p>
                <h4 class="card-title">目的</h4>
                <p class="card-text ms-3">
                    {!! App\consts\MessageConst::PURPOSE !!}
                </p>
                <h4 class="card-title">使い方</h4>
                <ol class="card-text">
                    {!! App\consts\MessageConst::USAGE !!}
                </ol>
                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="btn btn-outline-info" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        </div>
    </div>
@endsection
