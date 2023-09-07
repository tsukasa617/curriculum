@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">法人案件流入経路編集</span><br>
        <span style="font-size: 20px;"><font color="red">アプリケーションの動作に影響しますので、操作には十分注意願います。</font></span>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session('message') }}</li>
            </ul>
        </div>
    @endif

    <div>
        <ul class="sub_menu">
            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal1">新規登録</button>
            <!-- ↓モーダル表示部分↓ -->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form action="{{ action('MatterController@matter_advertising_add') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="label1">法人顧客流入経路名追加</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>流入経路名</p>
                            <div class="text-center">
                                <input type="text" class="form-control" name="advertising_name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                            <input type="submit" value="登録" class="btn btn-primary">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </ul>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>番号</th>
                    <th>流入経路名</th>
                    <th class="detail_space"></th>
                    <th class="detail_space"></th>
                </tr>
            </thead>
            <tbody class="table">
            @php
                $i = 0;
            @endphp
            @foreach($advertisings as $advertising)
                <tr>
                    <td>{{ $advertising->id }}</td>
                    <td>{{ $advertising->advertising_name }}</td>
                    <td>
                        <button type="button" class="btn-sm btn-primary"  data-toggle="modal" data-target="#upd_modal<?php print "$i" ?>">変更</button>
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="upd_modal<?php print "$i" ?>" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ action('MatterController@matter_advertising_update',['id' => $advertising->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="label1">流入経路名変更</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>流入経路名</p>
                                        <input type="text" class="form-control" name="advertising_name" value="{{ $advertising['advertising_name'] }}" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                        <input type="submit" value="変更" class="btn btn-primary">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn-sm btn-danger"  data-toggle="modal" data-target="#del_modal<?php print "$i" ?>">削除</button>
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="del_modal<?php print "$i" ?>" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="label1">注意：削除しますか？</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        流入経路名：{{ $advertising->advertising_name }}
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ action('MatterController@matter_advertising_delete',['id' => $advertising->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                            <input type="submit" value="削除" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @php
                $i += 1;
            @endphp
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection