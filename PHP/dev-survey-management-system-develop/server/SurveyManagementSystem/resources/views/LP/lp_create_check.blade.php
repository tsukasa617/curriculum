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

        <!-- Styles -->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/layout.css') }}" rel="stylesheet">
    </head>
    <body class="lp-back-color">
        @section('title', '管理システム')

        @section('content')

        <div class="container" style="padding-top: 6rem;">
            <div class="lp-container-inner">
                <h2 class="lp-head cjkB">以下の内容で登録します</h2>
                <div>
                    <button onclick="location.href='{{ action('ClientController@all') }}'" class="btn btn-secondary">一覧へ</a></button>
                </div>
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
                    <div class="enter_check_top lp-back">
                        <div><a class="btn btn-secondary" onclick="history.back()">調査会社選択に戻る</a></div>
                    </div>
                    <form action="{{ action('LpController@add') }}" method="POST">
                    {{ csrf_field() }}
                        <div id="detail_menu" class="lp-table">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">1.ご指名</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">{{ $lps["contractor"] }}</td>
                                    <input type="hidden" value="{{ $lps['contractor'] }}" name="contractor">
                                </tr>
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">2.お住いの都道府県</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">{{ $lps["prefecture"] }}</td>
                                    <input type="hidden" value="{{ $lps['prefecture'] }}" name="prefecture">
                                </tr>
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">3.お住いの市区町村</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">{{ $lps["city"] }}</td>
                                    <input type="hidden" value="{{ $lps['city'] }}" name="city">
                                </tr>
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">4.ビル名</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">{{ $lps["buildingname"] }}</td>
                                    <input type="hidden" value="{{ $lps['buildingname'] }}" name="buildingname">
                                </tr>
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">5.火災保険の加入状況</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">
                                        @if($lps["fire_insurance_flg"] == '0')
                                            @php print '未加入'; @endphp
                                        @else
                                            @php print '加入している'; @endphp
                                        @endif
                                    </td>
                                    <input type="hidden" value="{{ $lps['fire_insurance_flg'] }}" name="fire_insurance_flg">
                                </tr>
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">6.火災保険会社名</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">{{ $lps["insurance_company"] }}</td>
                                    <input type="hidden" value="{{ $lps['insurance_company'] }}" name="insurance_company">
                                </tr>
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">7.電話番号</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">{{ $phone }}</td>
                                    <input type="hidden" value="{{ $lps['contractor_contact'] }}" name="contractor_contact">
                                </tr>
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">8.メールアドレス</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">{{ $lps["mail_address"] }}</td>
                                    <input type="hidden" value="{{ $lps['mail_address'] }}" name="mail_address">
                                </tr>
                                <tr>
                                    <th class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">9.調査会社</th>
                                    <td class="lp-match-Content-Item lp-Content-Left-Item-Label cjkB">{{ $lps["survey_name"] }}</td>
                                    <input type="hidden" value="{{ $lps['survey_name'] }}" name="survey_name">
                                    
                                </tr>
                            </table>
                        </div>
                        <div>
                            <input type="image" id="button" value="内容を送信" class="lp-Form-Btn" src="/image/contact-submit-btn.png">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
