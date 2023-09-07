@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">調査会社編集確認</span>
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

    <div class="enter_check_top">
        <div id="enter_check">以下の内容で修正します</div>
        <div><a class="btn btn-secondary" onclick="history.back()">入力フォーム戻る</a></div>
    </div>

    <form action="{{ action('SurveyCorpController@update') }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{ $values['id'] }}">
        <div id="detail_menu">
            <table class="table table-bordered">

                <tr>
                    <th>会社名</th>
                    <td class="table-light">{{ $values['survey_name'] }}</td>
                    <input type="hidden" value="{{ $values['survey_name'] }}" name="survey_name">
                </tr>

                <tr>
                    <th>郵便番号</th>
                    <td class="table-light">{{ $values['survey_zipcode'] }}</td>
                    <input type="hidden" value="{{ $values['survey_zipcode'] }}" name="survey_zipcode">
                </tr>

                <tr>
                    <th>住所</th>
                    <td class="table-light">{{ $values['survey_address'] }}</td>
                    <input type="hidden" value="{{ $values['survey_address'] }}" name="survey_address">
                </tr>

                <tr>
                    <th>電話番号</th>
                    <td class="table-light">{{ $values['survey_phone'] }}</td>
                    <input type="hidden" value="{{ $values['survey_phone'] }}" name="survey_phone">
                </tr>

                <tr>
                    <th>メールアドレス</th>
                    <td class="table-light">{{ $values['survey_mail'] }}</td>
                    <input type="hidden" value="{{ $values['survey_mail'] }}" name="survey_mail">
                </tr>

                <tr>
                    <th>Webサイト</th>
                    <td class="table-light">{{ $values['survey_url'] }}</td>
                    <input type="hidden" value="{{ $values['survey_url'] }}" name="survey_url">
                </tr>
            </table>
        </div>

        <div class="text-right">
            <input type="submit" value="修正" class="btn btn-info">
        </div>
    </form>
</div>
@endsection