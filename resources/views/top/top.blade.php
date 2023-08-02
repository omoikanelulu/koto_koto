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
                    {!! App\Consts\AppMessagesConst::INTRODUCTION !!}
                </p>
                <p class="card-text ms-3">
                    {!! App\Consts\AppMessagesConst::GLOSSARY !!}
                </p>
                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                <a class="btn btn-outline-info" href="{{ route('register') }}">{{ __('Register') }}</a>
                <a class="btn btn-outline-danger" href="{{ route('inquiry.form') }}">お問い合わせ</a>
            </div>
        </div>
    </div>
@endsection
