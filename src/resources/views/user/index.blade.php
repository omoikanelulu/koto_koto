@extends('layouts.app')

@section('content')
    @auth
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table>
                    @foreach ($users as $user)
                        <tr>
                            <td class="user">{{ $user->name }}</td>
                            <td class="user">{{ $user->email }}</td>
                            <div class="operation-buttons py-3">
                                <td>
                                    <a href="{{ route('user.show', $user) }}" class="text-decoration-none">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                                    </a>
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
                    @endforeach
                </table>
            </div>
        </div>
    @endauth
@endsection
