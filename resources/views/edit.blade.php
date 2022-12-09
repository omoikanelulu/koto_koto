@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 px-0">
修正画面
            <table>
                <tr>
                    <th>{{ $thing->registration_date }}</th>

                </tr>
                <tr>
                    <td>{{ $thing->thing }}</td>
                    <td>{{ $thing->bad_thing_workaround ?? '' }}</td>
                    <td>
                        <form action="destroy" method="post">
                            @csrf
                            <input type="hidden" name="{{ $thing->id }}">
                            <button class="btn-sm btn btn-outline-danger ms-5" type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
