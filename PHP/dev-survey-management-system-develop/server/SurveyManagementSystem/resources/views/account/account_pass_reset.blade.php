@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div>
  <span style="font-size: 30px; margin-left: 60px;">パスワードリセット</span>
</div>
<div class="container">
  <div class="text-right">
    <button onclick="location.href='{{ action('UserController@all') }}'" class="btn btn-primary">一覧に戻る</button>
  </div>

  <form action="{{ action('SurveyController@pass_reset') }}" method="POST">
    {{ csrf_field() }}

    @if (session('change_password_error'))
    <div class="container mt-2">
      <div class="alert alert-danger">
        {{session('change_password_error')}}
      </div>
    </div>
    @endif

    @if (session('change_password_success'))
    <div class="container mt-2">
      <div class="alert alert-success">
        {{session('change_password_success')}}
      </div>
    </div>
    @endif

    <h4>変更するユーザー：{{ Auth::user()->login }}</h4>

    <div class="form-group">
      <label for="password">新しいパスワード</label>
      <input id="password" type="password" class="form-control" name="new_password" required>
    </div>

    <div class="form-group">
      <label for="confirm">新しいパスワード(確認用)</label>
      <input id="confirm" type="password" class="form-control" name="new_password_confirmation" required>
    </div>

    <!-- hidden属性 -->
    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
    <input type="hidden" name="login" value="{{ Auth::user()->login }}">
    <input type="hidden" name="username" value="{{ Auth::user()->username }}">
    <input type="hidden" name="auth" value="{{ Auth::user()->auth }}">
    <!-- !!!!!!!!!! -->

    <?php
    echo Auth::user()->login;
    echo "<br>";
    echo Auth::user()->id;
    echo "<br>";
    echo Auth::user()->username;
    echo "<br>";
    echo Auth::user()->auth;
    echo "<br>";
    var_dump($_POST);

    ?>

    {{ csrf_field() }}
    <button type="button" class="btn btn-danger" style="width:150px" data-toggle="modal" data-target="#modal1">変更</button>
    <!-- ↓モーダル表示部分↓ -->
    <div class="modal fade" id="modal1" tabindex="-1" 　role="dialog" aria-labelledby="label1" aria-hidden="true">
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