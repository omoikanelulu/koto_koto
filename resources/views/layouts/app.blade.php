<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* ボタンの初期設定 */
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: none;
            font-size: 2rem;
            color: white;
            background-color: #007bff;
            border-radius: 50%;
            width: 3rem;
            height: 3rem;
            line-height: 2.8rem;
            text-align: center;
            cursor: pointer;
            transition: opacity 0.3s ease-in-out;
            z-index: 9999;
        }

        /* ボタンが表示される場合 */
        .back-to-top.show {
            display: block;
            opacity: 0.6;
        }

        /* スマホサイズ以下の場合のボタンの位置調整 */
        @media screen and (max-width: 576px) {
            .back-to-top {
                bottom: 1rem;
                right: 1rem;
            }
        }
    </style>

    <!-- headセクション内でjQueryを読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        {{-- ナビゲーションバー --}}
        <nav class="sticky-sm-top navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                @if (auth()->check())
                    {{-- ユーザがログイン中の処理 --}}
                    <a class="navbar-brand" href="{{ route('thing.index') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                @else
                    {{-- ユーザがログインしていない時の処理 --}}
                    <a class="navbar-brand" href="{{ route('top') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                @endif
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @yield('search_month')
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Route::has('thing.create'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('thing.create') }}">記録する</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (isset($user))
                                        <a class="dropdown-item" href="{{ route('user.show', $user) }}">
                                            ユーザ情報
                                        </a>
                                    @endif

                                    @if (isset($user))
                                        <a class="dropdown-item" href="{{ route('graph.index_chart', $user) }}">
                                            グラフで見る
                                        </a>
                                    @endif

                                    {{-- ログアウトボタン --}}
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    <!-- 画面のトップに戻るボタン -->
    <button id="back-to-top" class="btn btn-primary btn-sm back-to-top" type="button" aria-label="トップへ戻る">
        <span class="fa fa-chevron-up">↑</span>
    </button>

    {{-- トップページに戻るボタンの処理 --}}
    <script type="text/javascript">
        $(function() {
            // スクロールした際の動きを関数でまとめる
            function backToTop() {
                // スクロール量を取得
                var scroll = $(window).scrollTop();
                if (scroll >= 400) {
                    // 400px以上スクロールされた場合にボタンを表示
                    $('#back-to-top').addClass('show');
                } else {
                    // 400px未満の場合にボタンを非表示
                    $('#back-to-top').removeClass('show');
                }
            }
            // ページ読み込み時とスクロール時に実行
            $(window).on('load scroll', function() {
                backToTop();
            });
            // ボタンクリックでトップに戻る
            $('#back-to-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 200);
                return false;
            });
        });
    </script>

</body>

</html>
