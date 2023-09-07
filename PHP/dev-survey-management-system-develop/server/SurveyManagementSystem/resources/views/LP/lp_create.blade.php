<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        
        <title>申し込みフォーム</title>
        <!-- Scripts -->
        <script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('/js/app.js') }}" defer></script>
        <script src="{{ asset('js/search.js') }}"></script>
        <script src="{{ asset('js/common.js') }}"></script>
        <script type="module" src="{{ asset('js/lp_map.js') }}"></script>
        <script src="https://cdn.geolonia.com/community-geocoder.js"></script>

        <!-- Leaflet js.ライブラリ.地図表示-->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>

        <!-- Styles -->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/layout.css') }}" rel="stylesheet">
    </head>
    <body class="lp-back-color">
        @section('title', '管理システム')

        @section('content')

        
        <div class="container" style="padding-top: 6rem;">
            <div class="lp-container-inner">
                <h2 class="lp-head cjkB">調査会社をお選び下さい</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <!-- 地図表示 -->
                <div id="mapid" style="height: 500px;"></div>
                <div style="margin-top: 15px;">
                    <div class="enter_check_top">
                        <h3 class="lp-match-head-second tittle-fraise cjkB">おすすめの調査会社</h3>
                        <div class="lp-back"><a class="btn btn-secondary" onclick="history.back()">入力画面に戻る</a></div>
                    </div>
                    <form action="{{ action('LpController@create_check') }}" method="POST">
                        {{ csrf_field() }}
                            <input type="hidden" id="address" value="{{ $address }}">
                                @foreach($survey_recomends as $key => $survey_recomend)
                                    <div class="lp-match-Content lp-match-Content-top">
                                        <input class="form-check-input" type="radio" id="{{ $survey_recomend }}" name="survey_name" value="{{ $survey_recomend }}" required>
                                        <div class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">
                                            <label class="lp-match-label-bottom" for="{{ $survey_recomend }}">{{ $survey_recomend }}</label>
                                            <input type="hidden" id="name_{{ $key }}" name="name_{{ $key }}" value="{{ $survey_recomend }}">
                                        </div>
                                        <div class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB lp-match-item-mer">
                                            <label class="lp-match-label-bottom" for="{{ $survey_recomend }}">{{ $survey_add[$survey_recomend]['address'] }}</label>
                                            <input type="hidden" id="add_{{ $key }}" name="add_{{ $key }}" value="{{ $survey_add[$survey_recomend]['address'] }}">
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-secondary" id="search_{{ $key }}">検索</button>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id_{{ $key }}" name="id_{{ $key }}" value="{{ $survey_add[$survey_recomend]['id'] }}">
                                @endforeach
                            <input type="hidden" name="lps" value="{{ $lps }}">

                            
                            <div>
                                <input type="image" id="button" value="内容を送信" class="lp-Form-Btn" src="/image/contact-submit-btn.png">
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
