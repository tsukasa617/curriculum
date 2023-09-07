@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<style type="text/css">
table {
  border-collapse: collapse;
}

th, td {
  border: 1px solid #000;
  text-align: center;
}

td {
  line-height: 16px;
}

.span2 {
    line-height: 32px;
}
</style>
<div>
    <span style="font-size: 30px; margin-left: 60px;">進捗管理一覧</span>
</div>
<div class="container-field">
    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('success_message') }}</li>
        </ul>
    </div>
    @endif
    <div>
        <ul class="sub_menu">
            <a href="{{ action('ProgressController@create') }}" class="btn btn-primary">新規登録</a>
        </ul>
    </div>
    <div class="table_position">
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th>ステータス</th>
                    <th>管理ID</th>
                    <th>業者（カテゴリ）</th>
                    <th>会員番号</th>
                    <th>現調日</th>
                    <th>保険書類到着C</th>
                    <th>保険請求送付Re</th>
                    <th>保険認定C</th>
                    <th>保険入金C</th>
                    <th>請求書送付Re</th>
                    <th>入金Re</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach ($progress_managements as $value)
                <form action="{{ action('ProgressController@edit') }}" method="POST">
                    <tr>
                        <td rowspan="2">{{ $value['status_name'] }}</td>
                        <td rowspan="2">{{ $value['id'] }}</td>
                        <input type="hidden" name="id" value="{{ $value['id'] }}">
                        <td rowspan="2">{{ $value['trader_name'] }}</td>
                        <td rowspan="2">{{ $value['member_id'] }}</td>
                        <td rowspan="2">{{ $value['current_date'] }}</td>
                        <td>{{ $value['document_arrival_expected'] }}</td>
                        <td>{{ $value['insurance_send_bill_expected'] }}</td>
                        <td>{{ $value['insurance_ertification_expected'] }}</td>
                        <td>{{ $value['insurance_payment_expected'] }}</td>
                        <td>{{ $value['send_bill_expected'] }}</td>
                        <td>{{ $value['payment_expected'] }}</td>
                        <td id="obj1_{{ $value['id'] }}" rowspan="2"><input type="button" class="btn-sm btn-primary" value="編集" onclick="edit{{ $value['id'] }}();" name="btnid_{{ $value['id'] }}"/></td>
                        <td id="obj2_{{ $value['id'] }}" style="display: none;">
                            <!-- <a href="{{ action('ProgressController@delete',['id' => $value['id']]) }}"><button type="button" class="btn-sm btn-danger">削除</button></a> -->
                            <button type="button" class="btn-sm btn-danger" data-toggle="modal" data-target="#del_modal{{ $value['id'] }}">削除</button>
                            <!-- ↓モーダル表示部分↓ -->
                            <div class="modal fade" id="del_modal{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    {{ csrf_field() }}
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="label1">確認</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            注意：削除しますか？<br>
                                            管理ID：{{ $value['id'] }}<br>
                                            業者（カテゴリ）：{{ $value['trader_name'] }}<br>
                                            名前：<br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                            <a href="{{ action('ProgressController@delete',['id' => $value['id']]) }}">
                                                <button type="button" class="btn btn-danger">OK</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" class="form-control-sm" name="document_arrival_done" value="{{ $value['document_arrival_done'] }}" id="input1_{{ $value['id'] }}" style="display: none;">
                            <span style="display: block;" id="text1_{{ $value['id'] }}">{{ $value['document_arrival_done'] }}</span>
                        </td>
                        <td>
                            <input type="date" class="form-control-sm" name="insurance_send_bill_done" value="{{ $value['insurance_send_bill_done'] }}"  id="input2_{{ $value['id'] }}" style="display: none;">
                            <span style="display: block;" id="text2_{{ $value['id'] }}">{{ $value['insurance_send_bill_done'] }}</span>
                        </td>
                        <td>
                            <input type="date" class="form-control-sm" name="insurance_ertification_done" value="{{ $value['insurance_ertification_done'] }}"  id="input3_{{ $value['id'] }}" style="display: none;">
                            <span style="display: block;" id="text3_{{ $value['id'] }}">{{ $value['insurance_ertification_done'] }}</span>
                        </td>
                        <td>
                            <input type="date" class="form-control-sm" name="insurance_payment_done" value="{{ $value['insurance_payment_done'] }}"  id="input4_{{ $value['id'] }}" style="display: none;">
                            <span style="display: block;" id="text4_{{ $value['id'] }}">{{ $value['insurance_payment_done'] }}</span>
                        </td>
                        <td>
                            <input type="date" class="form-control-sm" name="send_bill_done" value="{{ $value['send_bill_done'] }}"  id="input5_{{ $value['id'] }}" style="display: none;">
                            <span style="display: block;" id="text5_{{ $value['id'] }}">{{ $value['send_bill_done'] }}</span>
                        </td>
                        <td>
                            <input type="date" class="form-control-sm" name="payment_done" value="{{ $value['payment_done'] }}"  id="input6_{{ $value['id'] }}"  style="display: none;">
                            <span style="display: block;" id="text6_{{ $value['id'] }}">{{ $value['payment_done'] }}</span>
                        </td>
                        <td id="obj3_{{ $value['id'] }}" style="display: none;"><input type="submit" class="btn-sm btn-primary" value="修正" /></td>
                    </tr>
                {{ csrf_field() }}
                </form>
                <script>
                    function edit{{ $value['id'] }} (){
                        var id = "{{ $value['id'] }}";
                        for(i = 1; i < 7; ++i){
                            var input = "input" + i + "_" + id;
                            var obj = document.getElementById(input);
                            obj.style.display ="block";
                            var text = "text" + i + "_" + id;
                            var obj = document.getElementById(text);
                            obj.style.display ="none";
                        }
                        var obj = document.getElementById("obj1_" + id);
                            obj.style.display ="none";
                        var obj = document.getElementById("obj2_" + id);
                            obj.style.display ="block";
                        var obj = document.getElementById("obj3_" + id);
                            obj.style.display ="block";
                    }
                </script>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection