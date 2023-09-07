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

    <form action="{{ action('AuthController@create_add') }}" method="POST">
    {{ csrf_field() }}
        <div id="detail_menu">
            <table class="table table-bordered">
                <tr>
                    <th>権限</th>
                    <td>{{ $auths['auth_name'] }}</td>
                </tr>
                <input type="hidden" value="{{ $auths['auth_name'] }}" name="auth_name">

                <tr>
                    <th>所持権限</th>
                    <td>
                        @foreach($authority_values['values'] as $authority_value)
                            <span style="margin-right : 10px;">{{ $authority_value }}</span>
                        @endforeach
                    </td>
                </tr>
                <input type="hidden" value="{{ $authority_json }}" name="authority">
            </table>
        </div>

        <div class="text-right">
            <button type="button" class="btn btn-secondary" onclick="history.back()">入力フォームへ戻る</button>
            <input type="submit" value="登録" class="btn btn-info">
        </div>
    </form>
</div>
@endsection