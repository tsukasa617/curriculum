@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">法人案件ステータス編集</span><br>
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
                    <form action="{{ action('MatterController@matter_status_add') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="label1">法人ステータス名追加</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>ステータス番号</p>
                            <div class="text-center">
                                <input type="text" class="form-control" name="status_number" required>
                            </div>
                            <br>
                            <p>ステータス名</p>
                            <div class="text-center">
                                <input type="text" class="form-control" name="status_name" required>
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
                    <th>ステータス番号</th>
                    <th>ステータス名</th>
                    <th class="detail_space"></th>
                    <th class="detail_space"></th>
                </tr>
            </thead>
            <tbody class="table">
            @php
                $i = 0;
            @endphp
            @foreach($statuses as $status)
                <tr>
                    <td>{{ $status->status_number }}</td>
                    <td>{{ $status->status_name }}</td>
                    <td>
                        <button type="button" class="btn-sm btn-primary"  data-toggle="modal" data-target="#upd_modal<?php print "$i" ?>">変更</button>
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="upd_modal<?php print "$i" ?>" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ action('MatterController@matter_status_update',['id' => $status->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="label1">ステータス名変更</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>ステータス番号</p>
                                        <input type="text" class="form-control" name="status_number" value="{{ $status['status_number'] }}" required>
                                        <br>
                                        <p>ステータス名</p>
                                        <input type="text" class="form-control" name="status_name" value="{{ $status['status_name'] }}" required>
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
                                        ステータス番号：{{ $status->status_number }}
                                        <br>
                                        ステータス名：{{ $status->status_name }}
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ action('MatterController@matter_status_delete',['id' => $status->id]) }}" method="POST">
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