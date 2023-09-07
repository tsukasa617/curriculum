@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<script src="{{ asset('js/auth_edit.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">

<div class="container">
    <div>
        <span style="font-size: 30px;">権限編集</span>
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
    @if (session('message'))
    <div class="alert alert-danger">
        <ul>
        <!-- 更新失敗メッセージ -->
            <li>{{ session('error_message') }}</li>
        </ul>
    </div>
    @endif

    <div>
        <ul class="text-right menu-right">
            <li>
                <div>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal1">アカウント削除</button>
                </div>
            </li>
            <li>
                <div>
                    <button onclick="location.href='{{ action('AuthController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
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
                        <a href="{{ action('AuthController@delete', ['id' => $auths['id'] ]) }}">
                            <button type="button" class="btn btn-danger">削除する</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ action('AuthController@edit_check') }}" method="POST" class="item-font-weight">
        {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $auths['id'] }}">
            <div class="form-group border border-info">
                <div class="col-sm-5 content_position">
                    <label>権限</label>
                    <b><font color="red">※必須</font></b>
                    <input type="text" class="form-control" name="auth_name" value="{{ $auths['auth_name'] }}" required>
                </div>
                    <div class="col-sm-7 content_position">
                        <label>所持権限</label><br>
                        <div class="form-check form-check-inline">
                            @if($auths['authority'][1] == "編集")
                                <input class="form-check-input" name="authority_edit" type="radio" id="inlineRadio01" value="編集" checked>
                            @else
                                <input class="form-check-input" name="authority_edit" type="radio" id="inlineRadio01" value="編集">
                            @endif
                            <label class="form-check-label" for="inlineRadio01">編集</label>
                        </div>
                        <div class="form-check form-check-inline">
                            @if($auths['authority'][2] == "削除")
                                <input class="form-check-input" name="authority_delete" type="radio" id="inlineRadio02" value="削除" checked>
                            @else
                                <input class="form-check-input" name="authority_delete" type="radio" id="inlineRadio02" value="削除">
                            @endif
                            <label class="form-check-label" for="inlineRadio02">削除</label>
                        </div>
                        <div class="form-check form-check-inline">
                            @if($auths['authority'][3] == "追加")
                                <input class="form-check-input" name="authority_add" type="radio" id="inlineRadio03" value="追加" checked>
                            @else
                                <input class="form-check-input" name="authority_add" type="radio" id="inlineRadio03" value="追加">
                            @endif
                            <label class="form-check-label" for="inlineRadio03">追加</label>
                        </div>
                        <div class="form-check form-check-inline">
                            @if($auths['authority'][4] == "ユーザー周り")
                                <input class="form-check-input" name="authority_user" type="radio" id="inlineRadio04" value="ユーザー周り" checked>
                            @else
                                <input class="form-check-input" name="authority_user" type="radio" id="inlineRadio04" value="ユーザー周り">
                            @endif
                            <label class="form-check-label" for="inlineRadio04">ユーザー周り</label>
                        </div>
                        <div class="form-check form-check-inline">
                            @if($auths['authority'][5] == "リグラント営業")
                                <input class="form-check-input" name="authority_sales" type="radio" id="inlineRadio05" value="リグラント営業" checked>
                            @else
                                <input class="form-check-input" name="authority_sales" type="radio" id="inlineRadio05" value="リグラント営業">
                            @endif
                            <label class="form-check-label" for="inlineRadio05">リグラント営業</label>
                        </div>
                        <div class="form-check form-check-inline">
                            @if($auths['authority'][6] == "調査会社")
                                <input class="form-check-input" name="authority_survey" type="radio" id="inlineRadio06" value="調査会社" checked>
                            @else
                                <input class="form-check-input" name="authority_survey" type="radio" id="inlineRadio06" value="調査会社">
                            @endif
                            <label class="form-check-label" for="inlineRadio06">調査会社</label>
                        </div>
                        <div class="form-check form-check-inline">
                            @if($auths['authority'][7] == "全画面")
                                <input class="form-check-input" name="authority_all_column" type="radio" id="inlineRadio07" value="全画面" checked>
                            @else
                                <input class="form-check-input" name="authority_all_column" type="radio" id="inlineRadio07" value="全画面">
                            @endif
                            <label class="form-check-label" for="inlineRadio07">全画面</label>
                        </div>
                    </div>
                <div class="col-sm-12 content_position">
                    <label>権限説明</label>
                    <p class="auth_line">
                        ＊編集：編集機能を使う権限<br>
                        ＊裏カラム：全ての項目を見ることができる権限（この権限がないと、調査会社に非表示にしている項目を見ることができません。）<br>
                        ＊削除：削除機能を使う権限（この権限がないと、削除ボタンは表示されません。）<br>
                        ＊追加：新規登録を行える権限（この権限がないと、新規登録ページ、新規登録ボタンは表示されません。）<br>
                        ＊ユーザー周り：権限、アカウントの編集を行える権限（この権限がないと、権限ページ、アカウントページは表示されません。）<br>
                        ＊リグラント営業：顧客画面の表示権限（顧客一覧画面に、リグラントの営業の人が見る画面を表示します。）<br>
                        ＊調査会社：顧客画面の表示権限（顧客一覧画面に、調査会社の人が見る画面を表示します。）<br>
                        ＊全画面：顧客画面の表示権限（顧客一覧画面に、全項目を表示します。）<br>
                    </p>
                </div>

                <script>
                    $('.chosen-select').chosen({
                        width: "350px",
                    });
                </script>

            </div>
            
            <div class="text-right">
                <input type="submit" value="修正確認" class="btn btn-info">
            </div>
    </form>
</div>
@endsection