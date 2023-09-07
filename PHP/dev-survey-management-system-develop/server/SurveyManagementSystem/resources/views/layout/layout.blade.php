<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>
        <!-- Scripts -->
        <script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('/js/app.js') }}" defer></script>
        <script src="{{ asset('js/search.js') }}"></script>
        <script src="{{ asset('js/common.js') }}"></script>

        <!-- Styles -->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/layout.css') }}" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light shadow">

            <div id="title">
                <a href="{{ action('SurveyController@index') }}" class="site_title">
                    <img src="/image/new_logo.png" width="250" height="43.09"/>
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".top_baner" aria-controls=".top_baner" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @if( Auth::check() )
            <div class="collapse navbar-collapse top_baner" id="menu">
                @php $authoritys = session()->get('authoritys'); @endphp
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">個人案件顧客リスト</a>
                            <div class="dropdown-menu">
                                <a href="{{ action('ClientController@all') }}" class="dropdown-item">個人案件顧客一覧</a>
                                @foreach($authoritys as $authorities)
                                    @if($authorities == "追加")
                                        <a href="{{ action('ClientController@create') }}" class="dropdown-item">個人案件顧客登録</a>
                                        <a href="{{ action('ClientController@client_status_all') }}" class="dropdown-item">個人案件顧客ステータス編集</a>
                                    @endif
                                @endforeach
                                @foreach($authoritys as $authorities)
                                    @if($authorities == "ユーザー周り")
                                        <a href="{{ action('ClientController@csv_import_view') }}" class="dropdown-item">顧客CSVインポート</a>
                                    @endif
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">法人案件顧客リスト</a>
                            <div class="dropdown-menu">
                                <a href="{{ action('MatterController@all') }}" class="dropdown-item">法人案件顧客一覧</a>
                                @foreach($authoritys as $authorities)
                                    @if($authorities == "追加")
                                        <a href="{{ action('MatterController@create') }}" class="dropdown-item">法人案件登録</a>
                                    @endif
                                @endforeach
                                @foreach($authoritys as $authorities)
                                    @if($authorities == "ユーザー周り")
                                        <a href="{{ action('MatterController@matter_status_all') }}" class="dropdown-item">法人案件顧客ステータス編集</a>
                                        <a href="{{ action('MatterController@matter_advertising_all') }}" class="dropdown-item">法人案件顧客流入経路編集</a>
                                        <a href="{{ action('MatterController@csv_import_view') }}" class="dropdown-item">法人顧客CSVインポート</a>
                                    @endif
                                @endforeach
                            </div>
                        </li>

                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">法人案件取次店管理表</a>
                            <div class="dropdown-menu">
                                <a href="{{ action('TraderController@all') }}" class="dropdown-item">法人案件取次店一覧</a>
                                @foreach($authoritys as $authorities)
                                    @if($authorities == "追加")
                                        <a href="{{ action('TraderController@create') }}" class="dropdown-item">取次店登録</a>
                                    @endif
                                @endforeach
                                @foreach($authoritys as $authorities)
                                    @if($authorities == "ユーザー周り")
                                        <a href="{{ action('TraderController@csv_import') }}" class="dropdown-item">取次店CSVインポート</a>
                                        <a href="{{ action('TraderController@reward') }}" class="dropdown-item">報酬・明細一覧</a>
                                    @endif
                                @endforeach
                            </div>
                        </li>

                        @foreach($authoritys as $authorities)
                            @if($authorities == "全画面" || $authorities == "リグラント営業")
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">調査会社管理</a>
                                    <div class="dropdown-menu">
                                        <a href="{{ action('SurveyCorpController@all') }}" class="dropdown-item">調査会社一覧</a>
                                        <a href="{{ action('SurveyCorpController@create') }}" class="dropdown-item">調査会社登録</a>
                                    </div>
                                </li>
                            @endif
                        @endforeach

                        @foreach($authoritys as $authorities)
                            @if($authorities == "ユーザー周り")
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">権限管理</a>
                                    <div class="dropdown-menu">
                                        <a href="{{ action('AuthController@all') }}" class="dropdown-item">権限一覧</a>
                                        <a href="{{ action('AuthController@create') }}" class="dropdown-item">権限登録</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">アカウント管理</a>
                                    <div class="dropdown-menu">
                                        <a href="{{ action('UserController@all') }}" class="dropdown-item">アカウント一覧</a>
                                        <a href="{{ action('UserController@create') }}" class="dropdown-item">アカウント登録</a>
                                        <a href="{{ action('LogController@all') }}" class="dropdown-item">ログ管理一覧</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">申し込み画面</a>
                                    <div class="dropdown-menu">
                                        <a href="{{ action('LpController@all') }}" class="dropdown-item" form target="_bank">申し込み一覧</a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
            </div>
            @endif

            @if( Auth::check() )
            <div class="collapse navbar-collapse justify-content-end top_baner" id="auth_info">
                <ul class="navbar-nav">
                    <li class="d-flex align-items-center login-now">ログイン中：{{ Auth::user()->username }}</li>
                    <li>
                        <a class="btn btn-link page-link d-inline-block shadow" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            @endif
        </nav>
        @yield('content')
    </body>
</html>