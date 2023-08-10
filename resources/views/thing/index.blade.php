@extends('layouts.app')

@section('search_month')
    @auth
        <div class="row">
            <div class="col">
                <li>
                    <form action="{{ route('thing.index') }}" method="get">
                        <input class="fs-5 rounded-3 border-0 text-center align-bottom" type="month" name="search_month"
                            id="search_month" value="{{ $search_month }}">
                        <input class="btn btn-outline-primary btn-sm ms-3" type="submit" value="表示する">
                    </form>
                </li>
            </div>
        </div>
    @endauth
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <table>
                @foreach ($things as $thing)
                    {{-- 入力日時の表示 --}}
                    <div class="d-flex align-items-center right-bg-line">
                        <div>
                            <time datetime="$thing->registration_date" class="fs-4">
                                {{ $thing->registration_date }}
                            </time>
                        </div>
                        {{-- アイコンを表示させるコンポーネントの呼び出し --}}
                        <x-icon-display :thing="$thing" />
                    </div>
                    {{-- デキゴトのコンポーネント呼び出し --}}
                    <div class="thing">
                        <p>{!! nl2br(e($thing->thing), false) !!}</p>
                    </div>
                    {{-- タイサクのコンポーネント呼び出し --}}
                    @empty(!$thing->bad_thing_workaround)
                        <div class="d-flex justify-content-end">
                            <x-bad-thing-workaround-display :thing="$thing" />
                        </div>
                    @endempty
                    {{-- 処理ボタンの表示 --}}
                    <div class="d-md-flex justify-content-end">
                        <div class="operation-buttons py-3">
                            <a href="{{ route('thing.show', $thing) }}" class="text-decoration-none">
                                <button type="button" class="btn btn-sm btn-outline-secondary">詳細</button>
                            </a>
                            <a href="{{ route('thing.edit', $thing) }}" class="text-decoration-none">
                                <button type="button" class="btn btn-sm btn-outline-warning">修正</button>
                            </a>
                            <form class="d-inline" action="{{ route('thing.destroy', $thing) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" onclick="return confirm('削除しますか？この処理は取り消せません');"
                                    class="btn-sm btn btn-outline-danger">削除</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </table>
        </div>
        {{-- ペジネーション --}}
        <div class="d-flex justify-content-center text-center"style="width: 500px;margin: 20px auto;">
            {{-- appends()で検索条件を引き継いでいる --}}
            {{ $things->appends(request()->input())->links() }}
        </div>
    </div>
@endsection
