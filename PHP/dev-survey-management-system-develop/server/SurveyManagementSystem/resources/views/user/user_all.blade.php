@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
    <script src="{{ asset('js/checkbox_user.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container">
    <div>
        <span style="font-size: 30px;">ユーザーアカウント一覧</span>
    </div>

    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
        <!-- 登録・更新成功メッセージ -->
            <li>{{ session('success_message') }}</li>
        </ul>
    </div>
    @endif
    @if (session('change_password_success'))
    <div class="alert alert-success">
        <ul>
        <!-- パスワード更新成功メッセージ -->
            <li>{{ session('change_password_success') }}</li>
        </ul>
    </div>
    @endif
    <div>
        @php $authoritys = session()->get('authoritys'); @endphp
        <ul class="matter_all_sub">
            <div class="matter_all_search">
                <form action="{{ action('UserController@filter_search') }}" method="POST">
                    {{ csrf_field() }}
                    <li class="list">
                        <input type="text" class="form-control" name="search" placeholder="キーワード検索">
                    </li>
                    <li>
                        <input type='submit' class="btn btn-primary" value='検索'>
                    </li>
                </form>
                <li>
                    <input type='button' class="btn btn-danger" value='削除' id='forget_value' style="display: none">
                </li>
            </div>
            <div>
                <a href="{{ action('UserController@create') }}" class="btn btn-outline-secondary">新規登録</a>
            </div>
        </ul>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 2em"><input type="checkbox" name="allchecked" id="all"></th>
                    <th class="detail_space"></th>
                    <th text-center header">ログインID</th>
                    <th text-center header">氏名</th>
                    <th text-center header">調査会社名</th>
                    <th text-center header">権限</th>
                    <th text-center header">取次店</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach($users as $user)
                <tr>
                    <td class="check"><input type="checkbox" name="chk[]" value="{{ $user->id }}" class="is"></td>
                    <td><button onclick="location.href='{{ action('UserController@edit', ['id' => $user->id]) }}'" class="btn-sm btn-info">編集</button></td>
                    <td>{{ $user->login }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->survey_name }}</td>
                    <td>{{ $user->auth_name }}</td>
                    <td>{{ $user->trader_name }}</td>
                    <td><a href="{{ action('UserController@pass_set', ['id' => $user->id]) }}" class="btn btn-outline-danger">パスワードリセット</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
@endsection
