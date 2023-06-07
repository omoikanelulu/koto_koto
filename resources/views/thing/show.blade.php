@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <table class="mb-3">
                <tr>
                    <th class="vw-100">
                        <h4 class="right-bg-line">{{ $thing->registration_date }}</h4>
                    </th>
                </tr>
                <tr>
                    <td class="thing">{!! nl2br(e($thing->thing), false) !!}</td>
                </tr>

                {{-- bad_thing_workaroundが、存在する時の処理 --}}
                @empty(!$thing->bad_thing_workaround)
                    <tr class="d-flex justify-content-end">
                        <td class="bad-thing-workaround p-3 rounded-3">
                            {!! nl2br(e($thing->bad_thing_workaround), false) !!}</td>
                    </tr>
                @endempty
            </table>

            {{-- 操作ボタン --}}
            <table class="d-flex justify-content-end">
                <tr>
                    <td>
                        <div class="operation-buttons py-3">
                            <a href="{{ route('thing.index') }}" class="text-decoration-none">
                                <button type="button" class="btn btn-sm btn-outline-secondary">戻る</button>
                            </a>
                            <a href="{{ route('thing.edit', $thing) }}" class="text-decoration-none">
                                <button type="button" class="btn btn-sm btn-outline-warning">修正</button>
                            </a>
                            <form class="d-inline" action="{{ route('thing.destroy', $thing) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" onclick="return confirm('削除しますか？');"
                                    class="btn-sm btn btn-outline-danger">削除</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
