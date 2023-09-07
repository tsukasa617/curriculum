@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">権限編集確認</span>
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

    <div class="enter_check_top">
        <div id="enter_check">以下の内容で修正します</div>
    </div>

    <form action="{{ action('AuthController@update') }}" method="POST">
    {{ csrf_field() }}
        <div id="detail_menu">
            <table class="table table-bordered">
                <input type="hidden" name="id" value="{{ $auths['id'] }}">
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
            <input type="submit" value="修正" class="btn btn-info">
        </div>
    </form>
</div>
@endsection