@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">ユーザーアカウント登録確認</span>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li><br>
        @endforeach
        </ul>
    </div>
    @endif
    <span id="enter_check">以下の内容で登録します</span>
    <form action="{{ action('UserController@create_add') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div id="detail_menu">
            <table class="table table-bordered">
                <tr>
                    <th>ログインID</th>
                    <td>{{ $users["login"] }}</td>
                </tr>
                <input type="hidden" value="{{ $users['login'] }}" name="login">

                <tr>
                    <th>ログインパスワード</th>
                    <td>{{ $users["password"] }}</td>
                </tr>
                <input type="hidden" value="{{ $users['password'] }}" name="password">

                <tr>
                    <th>氏名</th>
                    <td>{{ $users["username"] }}</td>
                </tr>
                <input type="hidden" value="{{ $users['username'] }}" name="username">

                <tr>
                    <th>調査会社名</th>
                    <td>{{ $survey["id"] }}：{{ $survey["survey_name"] }}</td>
                </tr>
                <input type="hidden" value="{{$users['survey_id']}}" name="survey_id">

                <tr>
                    <th>権限</th>
                    <td>{{ $auths["id"] }}：{{ $auths["auth_name"] }}</td>
                </tr>
                <input type="hidden" value="{{ $users['auth_id'] }}" name="auth_id">

                <tr>
                    <th>取次店</th>
                    <td>{{ $traders["id"] }}：{{ $traders["trader_name"] }}</td>
                </tr>
                <input type="hidden" value="{{ $users['trader_id'] }}" name="trader_id">
            </table>
        </div>
        
        <div class="text-right">
            <button type="button" class="btn btn-secondary" onclick="history.back()">入力フォームへ戻る</button>
            <input type="submit" value="登録" class="btn btn-info">
        </div>
    </form>
</div>
@endsection