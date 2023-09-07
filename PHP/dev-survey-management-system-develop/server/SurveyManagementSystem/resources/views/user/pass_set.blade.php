@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">パスワードリセット</span>
</div>
<div class="container">
    <form action="{{ action('UserController@pass_reset') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="hidden" name="id" value="{{ $users['id'] }}">

        @if (session('change_password_error'))
        <div class="alert alert-danger">
            <ul>
            <!-- パスワード更新失敗メッセージ -->
                <li>{{ session('change_password_error') }}</li>
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

        <h4>選択ユーザー：{{ $users->login }}</h4>

        <h4>氏名：{{ $users->username }}</h4>

        <div class="text-right">
            <button onclick="location.href='{{ action('UserController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
        </div>

        <!-- <div class="form-group">
            <label for="current">現在のパスワード</label>
            <input id="current" type="password" class="form-control" name="current_password" required>
        </div> -->

        <div class="form-group">
            <label for="password">新しいパスワード</label>
            <input id="password" type="password" class="form-control" name="new_password" required>
            @if ($errors->has('new_password'))
            <span class="help-block">
                <strong>{{ $errors->first('new_password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <label for="confirm">新しいパスワード(確認用)</label>
            <input id="confirm" type="password" class="form-control" name="new_password_confirmation" required>
        </div>

        <button type="button" class="btn btn-danger" style="width:150px" data-toggle="modal" data-target="#modal1">変更</button>
        <!-- ↓モーダル表示部分↓ -->
        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="label1">確認</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        パスワードをリセットしますか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <input type="submit" class="btn btn-danger" value="変更">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
