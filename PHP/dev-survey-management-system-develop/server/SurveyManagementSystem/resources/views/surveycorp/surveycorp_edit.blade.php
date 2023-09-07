@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">調査会社編集</span>
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

    <div id="detail_menu">
        <form action="{{ action('SurveyCorpController@edit_check') }}" method="POST">
            <table class="table table-bordered" style="margin-top: 10px;">

                <input type="hidden" name="id" value="{{ $values['id'] }}">

                <tr>
                    <th>会社名<font color="red">＊</font></th>
                    <td><input type="text" class="form-control" name="survey_name" value="{{ $values['survey_name'] }}" maxlength="100" required></td>
                </tr>

                <tr>
                    <th>郵便番号</th>
                    <td><input type="text" class="form-control" name="survey_zipcode" value="{{ $values['survey_zipcode'] }}" maxlength="7" ></td>
                </tr>

                <tr>
                    <th>住所<font color="red">＊</font></th>
                    <td><input type="text" class="form-control" name="survey_address" value="{{ $values['survey_address'] }}" maxlength="100" ></td>
                </tr>

                <tr>
                    <th>電話番号</th>
                    <td><input type="text" class="form-control" name="survey_phone" value="{{ $values['survey_phone'] }}" maxlength="13" ></td>
                </tr>

                <tr>
                    <th>メールアドレス</th>
                    <td><input type="email" class="form-control" name="survey_mail" value="{{ $values['survey_mail'] }}" maxlength="100"></td>
                </tr>

                <tr>
                    <th>Webサイト</th>
                    <td><input type="url" class="form-control" name="survey_url" value="{{ $values['survey_url'] }}" maxlength="255"></td>
                </tr>
            </table>

            {{ csrf_field() }}
            <div class="text-right">
                <input type="submit" value="内容確認" class="btn btn-info">
            </div>

        </form>
    </div>
</div>
@endsection