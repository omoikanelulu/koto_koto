@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">氏名</th>
                        <th scope="col">メールアドレス</th>
                        <th scope="col">登録日</th>
                        <th scope="col">最終更新日</th>
                    </tr>
                </thead>
                <tbody>
                    <td class="user">{{ $user->name }}</td>
                    <td class="user">{{ $user->email }}</td>
                    <td class="user">{{ $user->created_at->format('Y-m-d') }}</td>
                    <td class="user">{{ $user->updated_at->format('Y-m-d') }}</td>
                </tbody>
            </table>
            <div class="operation-buttons py-3">
                <a href="{{ route('user.edit', $user) }}" class="text-decoration-none">
                    <button type="button" class="btn btn-sm btn-outline-warning">修正</button>
                </a>
                <a href="{{ route('thing.index') }}">
                    <button type="button" class="btn btn-sm btn-secondary">戻る</button>
                </a>
            </div>
        </div>
    </div>
@endsection
