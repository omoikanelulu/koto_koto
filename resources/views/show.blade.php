@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="d-flex justify-content-center col-lg-12">
            <table>
                <tr>
                    <th>
                        <h4>{{ $thing->registration_date }}</h4>
                    </th>
                </tr>
                <tr>
                    <td>{{ $thing->thing }}</td>
                </tr>
                <tr>
                    <td class="ps-4">{{ $thing->bad_thing_workaround ?? '' }}</td>
                </tr>
                <tr>
                    <th>当時の気持ち</th>
                    @if ($thing->good_thing_order == 1)
                        <td>すごくイイ</td>
                    @elseif ($thing->good_thing_order == 2)
                        <td>イイ</td>
                    @elseif($thing->good_thing_order == 3)
                        <td>ちょっとイイ</td>
                    @else
                        <td>{{ '' }}</td>
                    @endif

                    @if ($thing->bad_thing_order == 1)
                        <td>すごくイヤ</td>
                    @elseif ($thing->bad_thing_order == 2)
                        <td>イヤ</td>
                    @elseif($thing->bad_thing_order == 3)
                        <td>ちょっとイヤ</td>
                    @else
                        <td>{{ '' }}</td>
                    @endif
                </tr>
                <tr>
                    <td class="d-flex justify-content-end">
                        <div class="py-3">

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
