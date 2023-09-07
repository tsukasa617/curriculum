@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<script src="{{ asset('js/auth_table.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div>
        <span style="font-size: 30px;">権限一覧</span>
    </div>

    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
        <!-- 登録・更新成功メッセージ -->
            <li>{{ session('success_message') }}</li>
        </ul>
    </div>
    @endif
    
    <div style="margin-bottom:10px">
        <ul class="matter_all_sub">
            <div>
                <a href="{{ action('AuthController@create') }}" class="btn btn-outline-secondary">新規登録</a>
            </div>
        </ul>
    </div>

    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="detail_space"></th>
                    <th>ID</th>
                    <th>権限</th>
                    <th>所持権限</th>
                    <th>権限説明</th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach($auths as $auth)
                <tr>
                    <td><button onclick="location.href='{{ action('AuthController@edit', ['id' => $auth->id]) }}'" class="btn-sm btn-primary">編集</button></td>
                    <td>{{ $auth->id }}</td>
                    <td>{{ $auth->auth_name }}</td>
                    <td>
                        @foreach($auth['authority'] as $auth_authority)
                            <li>
                                {{ $auth_authority }}
                            </li>
                        @endforeach
                    </td>
                    @if($auth->id == 1)
                        <td id="row_span" style="font-weight:bold;color:red">
                    
                            ＊編集：<br>編集機能を使う権限<br><br>
                            ＊削除：<br>削除機能を使う権限<br><br>
                            ＊追加：<br>新規登録を行える権限<br><br>
                            ＊ユーザー周り：<br>権限、アカウントの編集を行える権限<br><br>
                            ＊リグラント営業：<br>顧客画面の表示権限<br><br>
                            ＊調査会社：<br>顧客画面の表示権限<br><br>
                            ＊全画面：<br>顧客画面の表示権限<br><br>
                            
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            {{--  jsでrowspanの値をidの最後の値にしている --}}
            <form>
                <input type="hidden" id="row_number" value="{{ $auth['id'] }}">
            </form>
        </table>
        {{ $auths->links() }}
    </div>
</div>
@endsection
