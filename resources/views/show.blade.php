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
                @empty(!$thing->bad_thing_workaround)
                    <tr class="d-flex justify-content-end">
                        <td class="bad-thing-workaround p-3 rounded-pill">
                            {!! nl2br(e($thing->bad_thing_workaround), false) !!}</td>
                    </tr>
                @endempty
            </table>
            @empty(!$thing->thing_flag)
                <h5 class="border-bottom pb-1">当時のキモチ</h5>
                <table class="table">
                    <tr>
                        @if ($thing->good_thing_order == 1)
                            <td class="border-0">すごくイイ</td>
                        @elseif ($thing->good_thing_order == 2)
                            <td class="border-0">イイ</td>
                        @elseif($thing->good_thing_order == 3)
                            <td class="border-0">ちょっとイイ</td>
                        @else
                            <td class="border-0">{{ '' }}</td>
                        @endif

                        @if ($thing->bad_thing_order == 1)
                            <td class="border-0">すごくイヤ</td>
                        @elseif ($thing->bad_thing_order == 2)
                            <td class="border-0">イヤ</td>
                        @elseif($thing->bad_thing_order == 3)
                            <td class="border-0">ちょっとイヤ</td>
                        @else
                            <td class="border-0">{{ '' }}</td>
                        @endif
                    </tr>
                </table>
            @endempty
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
