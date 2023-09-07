@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">

<div class="container">
    <div>
        <span style="font-size: 30px;">ユーザーアカウント登録</span>
    </div>

    {{-- 更新失敗時にメッセージを表示 --}}
    @if (session('error_message'))
    <div class="alert alert-danger">
        <ul>
        <!-- 更新失敗メッセージ -->
            <li>
                {{ session('error_message') }}
            </li>
        </ul>
    </div>
    @endif

    @if ($errors->any())    
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="enter_check_top">
        <div id="enter_check"><font color="red">＊入力必須項目です</font></div>
        <div>
            <button onclick="location.href='{{ action('UserController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
        </div>
    </div>

    <form action="{{ action('UserController@create_check') }}" method="POST">
        <div class="form-group border border-info">
            <div class="col-sm-4">
                <label>ログインID</label>
                <b><font color="red">＊</font></b>
                <input type="text" class="form-control" name="login" value="{{ old('login') }}" maxlength="30" required>
            </div>

            <div class="col-sm-4">
                <label>氏名</label>
                <b><font color="red">＊</font></b>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" maxlength="20" required>
            </div>

            <div class="col-sm-5">
                <label>ログインパスワード</label>
                <b><font color="red">＊</font></b>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="col-sm-6">
                <label>ログインパスワード（確認）</label>
                <b><font color="red">＊</font></b>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="col-sm-4">
                <label>調査会社名</label>
                <b><font color="red">＊</font></b>
                <select name="survey_id" class="form-control surveies" required>
                    <option value= '' selected>-</option>
                    @foreach($surveies as $survey)
                        <option value="{{ $survey['id'] }}" @if(old('survey_id') == $survey['id']) selected @endif>{{ $survey['id'] }}：{{ $survey['survey_name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4">
                <label>権限</label>
                <b><font color="red">＊</font></b>
                <select name="auth_id" class="form-control auths" required>
                    <option value= '' selected>-</option>
                    @foreach($auths as $auth)
                        <option value="{{ $auth['id'] }}" @if(old('auth_id') == $auth['id']) selected @endif>{{ $auth['id'] }}:{{ $auth['auth_name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4">
                <label>取次店</label>
                <select name="trader_id" class="form-control traders">
                    <option value= '' selected>-</option>
                    @foreach($traders as $trader)
                        <option value="{{ $trader['id'] }}" @if(old('trader_id') == $trader['id']) selected @endif>{{ $trader['id'] }}:{{ $trader['trader_name'] }}</option>
                    @endforeach
                </select>
            </div>

            <script>
                $('.chosen-select').chosen({
                    width: "350px",
                });
            </script>

        </div>

        {{ csrf_field() }}
        <div class="text-right">
            <input type="submit" value="登録確認" class="btn btn-info">
        </div>
    </form>
</div>
@endsection