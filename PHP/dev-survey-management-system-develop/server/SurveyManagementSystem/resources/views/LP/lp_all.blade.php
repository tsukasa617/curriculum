<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
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
                @if(session('error_message'))
                    <div class="alert alert-done">
                    <!-- 登録失敗メッセージ -->
                    {{ session('error_message') }}
                    </div>
                @endif
                <h2 class="lp-head cjkB">申し込みフォーム</h2>
                <div>
                    <button onclick="location.href='{{ action('ClientController@all') }}'" class="btn btn-secondary">一覧へ</button>
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
                
                    <form action="{{ action('LpController@create') }}" method="POST" id="form" name="form">
                    {{ csrf_field() }}
                        <div class="lp-Content">
                            <div class="lp-Content-Left">
                                <div class="lp-Content-Item">
                                    <label for="contractor" class="lp-Content-Left-Item-Label cjkB">Q1.ご氏名<span class="lp-Content-Left-Item-Label-Required cjkB">必須</span></label>
                                    <div class="lp-Content-Item-Wrap">
                                        <span class="wpcf7-form-control-wrap">
                                            <input type="text" id="contractor" class="lp-Content-Item-Input" name="contractor" value="{{ old('contractor') }}" required>
                                        </span>
                                    </div>
                                </div>
                                <div class="lp-Content-Item lp-top">
                                    <label for="prefecture" class="lp-Content-Left-Item-Label cjkB">Q2.お住まいの都道府県<span class="lp-Content-Left-Item-Label-Required cjkB">必須</span></label>
                                    <div class="lp-Content-Item-Wrap">
                                        <span class="wpcf7-form-control-wrap">
                                            <select name="prefecture" id="prefecture" class="lp-Content-Item-Input" required>
                                                <option value='' selected>選択して下さい。</option>
                                                @foreach($prefectures as $prefecture)
                                                    <option value="{{ $prefecture }}" @if(old('prefecture') == $prefecture) selected @endif>{{ $prefecture }} </option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="lp-Content-Item lp-top">
                                    <label for="city" class="lp-Content-Left-Item-Label cjkB">Q3.お住いの市区町村<span class="lp-Content-Left-Item-Label-Required cjkB">必須</span></label>
                                    <div class="lp-Content-Item-Wrap">
                                        <span class="wpcf7-form-control-wrap">
                                            <input type="text" id="city" class="lp-Content-Item-Input" name="city" value="{{ old('city') }}" required placeholder="例: 豊島区西池袋3-22">
                                        </span>
                                    </div>
                                </div>
                                <div class="lp-Content-Item lp-top">
                                    <label for="buildingname" class="lp-Content-Left-Item-Label cjkB">Q4.ビル名</label>
                                    <div class="lp-Content-Item-Wrap">
                                        <span class="wpcf7-form-control-wrap">
                                            <input type="text" id="buildingname" class="lp-Content-Item-Input" name="buildingname" value="{{ old('buildingname') }}"  placeholder="例: 国土西池ビル F5">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="lp-Content-Right">
                                <div class="lp-Content-Item">
                                    <label for="fire_insurance_flg" class="lp-Content-right-Item-Label cjkB">Q5.火災保険の加入状況<span class="lp-Content-Left-Item-Label-Required cjkB">必須</span></label>
                                    <div class="lp-Content-Item-Wrap">
                                        <span class="wpcf7-form-control-wrap">
                                            <select name="fire_insurance_flg" id="fire_insurance_flg" class="lp-Content-Item-Input" required>
                                                <option value='' selected>選択して下さい。</option>
                                                <option value='1' @if(old('fire_insurance_flg') == '1') @endif>加入している</option>
                                                <option value='0' @if(old('fire_insurance_flg') == '0') @endif>加入していない</option>
                                            </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="lp-Content-Item  lp-top">
                                    <label for="insurance_company" class="lp-Content-right-Item-Label cjkB">Q6.火災保険会社名</label>
                                    <div class="lp-Content-Item-Wrap">
                                        <span class="wpcf7-form-control-wrap">
                                            <input type="text" id="insurance_company" class="lp-Content-Item-Input" name="insurance_company" value="{{ old('insurance_company') }}">
                                        </span>
                                    </div>
                                </div>
                                <div class="lp-Content-Item lp-top">
                                    <label for="contractor_contact" class="lp-Content-right-Item-Label cjkB">Q7.電話番号<span class="lp-Content-Left-Item-Label-Required cjkB">必須</span></label>
                                    <div class="lp-Content-Item-Wrap">
                                        <span class="wpcf7-form-control-wrap">
                                            <input type="text" id="contractor_contact" class="lp-Content-Item-Input" name="contractor_contact" value="{{ old('contractor_contact') }}" maxlength="13" placeholder="半角数字のみ入力して下さい" required>
                                        </span>
                                    </div>
                                </div>
                                <div class="lp-Content-Item lp-top">
                                    <label for="mail_address" class="lp-Content-right-Item-Label cjkB">Q8.メールアドレス<span class="lp-Content-Left-Item-Label-Required cjkB">必須</span></label>
                                    <div class="lp-Content-Item-Wrap">
                                        <span class="wpcf7-form-control-wrap">
                                            <input type="mail_address" id="mail_address" class="lp-Content-Item-Input" name="mail_address" value="{{ old('mail_address') }}" maxlength="100" required>
                                        </span>
                                    </div>
                                </div>
                            </div>
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
