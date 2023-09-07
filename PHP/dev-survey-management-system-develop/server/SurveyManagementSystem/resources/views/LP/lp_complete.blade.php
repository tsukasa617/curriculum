<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>申し込み完了</title>
        <!-- Scripts -->
        <script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('/js/app.js') }}" defer></script>
        <script src="{{ asset('js/search.js') }}"></script>
        <script src="{{ asset('js/common.js') }}"></script>
        
        <!-- Styles -->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/layout.css') }}" rel="stylesheet">
    </head>
    <body class="lp-back-color">
        @section('title', '管理システム')

        @section('content')

        <div class="container" style="padding-top: 6rem;">
            <div class="lp-container-inner">
                <h2 class="lp-head cjkB">申し込み受付完了</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <div style="margin-top: 15px;">
                    <p class="cjkB lp-Content-Left-Item-Label" style="text-align:center;">後日調査会社よりご連絡いたします。</p>
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <button onclick="location.href='{{ action('LpController@all') }}'" class="btn btn-secondary">申し込みトップへ</button>
                        <button style="margin:0 5px;" class="btn btn-secondary" onclick="window.close()">閉じる</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
