@extends('layouts.app')

@section('content')
    @guest
        <div class="row">
            <div class="card col-lg-12 px-0">
                <div class="card-header">
                    <h2>koto-koto</h2>
                </div>
                <div class="card-body">
                    <h4 class="card-title">koto-kotoとは？</h4>
                    <p class="card-text ms-3">
                        自己肯定感を向上させる方法のひとつに「寝る前にその日にあったいいことを3つ書き出す」という方法があります。<br>
                        この方法は、アメリカの心理学者であるマーティン・セリグマン氏が唱えているもので、「スリー・グッド・シングス」と呼ばれているそうです。<br>
                        一方で日常生活の中には、ストレスとなる要因（ストレッサー）も多くあります、ストレスに対する対処法を「ストレスコーピング」と言います。<br>
                        ストレスコーピング理論の基礎となっているのが、アメリカの研究者であったラザルスのストレス理論です。<br>
                        ストレス理論ではストレッサーと対処法がポイントであり、ストレッサーへの対処法が分かっていると、ストレスを軽減出来る事を示しています。<br>
                    </p>
                    <h4 class="card-title">目的</h4>
                    <p class="card-text ms-3">
                        生活の中で感じた事（デキゴト）を記録していく。就寝前にその日を振り返る<br>
                        記録したデキゴトの中からイイコトのベスト3を選ぶ事で、楽しかった事を思い出したり、良かった事を探す事で自己肯定感の向上に役立てる<br>
                        記録したデキゴトの中からヤナコトに選んだ物は、その事柄（ストレッサー）に対しての評価を行い、対処法を考える事でストレスコーピング能力の向上に役立てる<br>
                        また、ヤナコトの強度を付ける事で自分が何に対してストレスを感じるのか、傾向を視覚化する<br>
                    </p>
                    <h4 class="card-title">使い方</h4>
                    <ol class="card-text">
                        <li>深く考えずにメモ感覚でデキゴトを記録する</li>
                        <li>空いた時間に記録したデキゴトを見返す</li>
                        <li>イイコトだったかヤナコトだったか振り分ける</li>
                        <li>今日のイイコトベスト3を決める（就寝前に行うと良い効果）</li>
                        <li>ヤナコトに対する対処法を考える（ストレスに対する対処法を持つ事でストレス軽減に繋げる）</li>
                    </ol>
                    <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    <a class="btn btn-outline-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <table>
                    @foreach ($things as $thing)
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
                        <tr class="d-md-flex justify-content-end">
                            <td>
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
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="d-flex justify-content-center text-center"style="width: 500px;margin: 20px auto;">
                {{ $things->links() }}
            </div>
        </div>
    @endguest
@endsection
