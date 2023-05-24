@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('user.update', $user) }}" method="post">
        @method('PATCH')
        @csrf
        <div class="col-lg-6 offset-lg-3">
            <label for="name" class="form-label">ユーザ名</label>
            <input class="form-control @error('name') is-invalid @enderror" aria-describedby="validate" type="text"
                name="name" id="name" value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="invalid-feedback" id="validate">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-lg-6 offset-lg-3">
            <label for="email" class="form-label">メールアドレス</label>
            <input class="form-control @error('email') is-invalid @enderror" aria-describedby="validate" type="text"
                name="email" id="email" value="{{ old('email', $user->email) }}">
            @error('email')
                <div class="invalid-feedback" id="validate">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-lg-6 offset-lg-3">
            <button type="submit" class="btn btn-sm btn-primary">変更する</button>

            {{-- // 2023_0201 記述中 --}}
            <form class="d-inline" action="{{ route('user.destroy', $user) }}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" onclick="return confirm('退会しますか？この処理は取り消せません');"
                    class="btn-sm btn btn-danger">退会する</button>
            </form>

            <a href="{{ route('thing.index') }}">
                <button type="button" class="btn btn-sm btn-secondary">戻る</button>
            </a>
        </div>
    </form>
@endsection















{{-- @section('content')
    @auth
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table>
                    <tr>
                        <th>氏名</th>
                        <td class="user">{{ $user->name }}</td>
                        <th>メールアドレス</th>
                        <td class="user">{{ $user->email }}</td>
                        <th>登録日</th>
                        <td class="user">{{ $user->created_at->format('Y-m-d') }}</td>
                        <th>最終更新日</th>
                        <td class="user">{{ $user->updated_at->format('Y-m-d') }}</td>
                        <div class="operation-buttons py-3">
                            <td>
                                <a href="{{ route('user.edit', $user) }}" class="text-decoration-none">
                                    <button type="button" class="btn btn-sm btn-outline-warning">修正</button>
                                </a>
                                <form class="d-inline" action="{{ route('user.destroy', $user) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" onclick="return confirm('削除しますか？この処理は取り消せません');"
                                        class="btn-sm btn btn-outline-danger">削除</button>
                                </form>
                            </td>
                        </div>
                    </tr>
                </table>
            </div>
        </div>
    @endauth
@endsection --}}
