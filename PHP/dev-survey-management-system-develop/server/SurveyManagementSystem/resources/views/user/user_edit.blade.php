@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">

<div class="container">
    <div>
        <span style="font-size: 30px;">従業員編集</span>
    </div>

    @if ($errors->any())    
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</il>
        @endforeach
        </ul>
    </div>
    @endif

    {{-- 更新失敗時にメッセージを表示 --}}
    @if (session('error_message'))
    <div class="alert alert-danger">
        <ul>
        <!-- 更新失敗メッセージ -->
            <li>{{ session('error_message') }}</li>
        </ul>
    </div>
    @endif

    <div class="enter_check_top">
        <div id="enter_check"><font color="red">＊入力必須項目です</font></div>

        <ul class="text-right menu-right">
            <li>
                <div>
                    <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal1">アカウント削除</button>
                </div>
            </li>
            <li>
                <div>
                    <button onclick="location.href='{{ action('UserController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
                </div>
            </li>
        </ul>
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
                        本当に削除しますか？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                        <a href="{{ action('UserController@delete', ['id' => $users['id'] ]) }}">
                            <button type="button" class="btn btn-danger">削除する</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ action('UserController@edit_check') }}" method="POST">
        {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $users['id'] }}">
            <div class="form-group border border-info">
                <div class="col-sm-4 content_position">
                    <label>ログインID</label>
                    <b><font color="red">＊</font></b>
                    <input type="text" class="form-control" name="login" value="{{ $users['login'] }}" maxlength="30" required>
                </div>

                <div class="col-sm-4 content_position">
                    <label>氏名</label>
                    <b><font color="red">＊</font></b>
                    <input type="text" class="form-control" name="username" value="{{ $users['username'] }}" maxlength="20" required>
                </div>

                <div class="col-sm-4 content_position">
                    <label>調査会社名</label>
                    <b><font color="red">＊</font></b>
                    <select name="survey_id" class="form-control surveies" required>
                        @foreach($surveies as $survey)
                            @if($users['survey_id'] == $survey['id'])
                            <option value="{{ $survey['id'] }}" selected>{{ $survey['id'] }}：{{ $survey['survey_name'] }}</option>
                            @else
                            <option value="{{ $survey['id'] }}">{{ $survey['id'] }}：{{ $survey['survey_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-6 content_position">
                    <label>権限</label>
                    <b><font color="red">＊</font></b>
                    <select name="auth_id" class="form-control auths" required>
                        @foreach($auths as $auth)
                            @if($users['auth_id'] == $auth['id'])
                            <option value="{{ $auth['id'] }}" selected>{{ $auth['id'] }}：{{ $auth['auth_name'] }}</option>
                            @else
                            <option value="{{ $auth['id'] }}">{{ $auth['id'] }}：{{ $auth['auth_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 content_position">
                    <label>取次店</label>
                    <select name="trader_id" class="form-control traders">
                        @foreach($traders as $trader)
                            @if($users['trader_id'] == $trader['id'])
                            <option value="{{ $trader['id'] }}" selected>{{ $trader['id'] }}：{{ $trader['trader_name'] }}</option>
                            @else
                            <option value="{{ $trader['id'] }}">{{ $trader['id'] }}：{{ $trader['trader_name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <script>
                    $('.chosen-select').chosen({
                        width: "350px",
                    });
                </script>

                <input type="hidden" name="password" value="{{ $users['password'] }}" required>
            </div>

            <div class="text-right">
                <input type="submit" value="修正確認" class="btn btn-info">
            </div>
    </form>
</div>
@endsection