@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">調査会社登録</span>
    </div>

    {{-- 更新失敗時のメッセージを表示 --}}
    @if (session('error_message'))
    <div class="alert alert-danger">
        <ul>
            <li>{{ session('error_message') }}</li>
        </ul>
    </div>
    @endif
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
        <div id="enter_check"><font color="red">＊入力必須項目です</font></div>
        <div>
            <button onclick="location.href='{{ action('SurveyCorpController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
        </div>
    </div>

    <form action="{{ action('SurveyCorpController@create_check') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group border border-info">

            <div class="col-sm-4 content_position">
                <label>会社名<font color="red">＊</font></label>
                <input type="text" class="form-control" name="survey_name" value="{{ old('survey_name') }}" maxlength="100" required>
            </div>

            <div class="col-sm-4 content_position">
                <label>郵便番号</label>
                <input type="text" class="form-control" name="survey_zipcode" maxlength="7" value="{{ old('survey_zipcode') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>住所<font color="red">＊</font></label>
                <input type="text" class="form-control" name="survey_address" maxlength="100" value="{{ old('survey_address') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>電話番号</label>
                <input type="text" class="form-control" name="survey_phone" maxlength="13" value="{{ old('survey_phone') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>メールアドレス</label>
                <input type="email" class="form-control" name="survey_mail"  maxlength="100" value="{{ old('survey_mail') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>Webサイト</label>
                <input type="url" class="form-control" name="survey_url" maxlength="255" value="{{ old('survey_url') }}">
            </div>
        </div>

        <div class="text-right">
            <input type="submit" value="登録確認" class="btn btn-info">
        </div>
    </form>
</div>
@endsection