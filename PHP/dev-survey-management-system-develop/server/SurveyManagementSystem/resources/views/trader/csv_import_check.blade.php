@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">CSVファイルインポート</span>
    </div>

    <div class="text-right" style="margin-bottom: 10px;">
        <button onclick="location.href='{{ action('TraderController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
    </div>
    <form action="{{ action('TraderController@csv_import_add') }}" method="POST">
    {{ csrf_field() }}
    <div>
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>紹介者</th>
                    <!----裏カラム--->
                    <th>VIP</th>
                    <th>取次店</th>
                    <!----裏カラム--->
                    <th>法人・個人</th>
                    <!----裏カラム--->
                    <th>メールアドレス</th>
                    <th>所属企業</th>
                    <th>役職</th>
                    <!----裏カラム--->
                    <th>郵便番号</th>
                    <!----裏カラム--->
                    <th>住所</th>
                    <!----裏カラム--->
                    <th>電話番号</th>
                    <!----裏カラム--->
                    <th>電話番号２</th>
                    <!----裏カラム--->
                    <th>契約書送付日</th>
                    <!----裏カラム--->
                    <th>契約書締結日</th>
                    <!----裏カラム--->
                    <th>主な案件</th>
                    <!----裏カラム--->
                    <th>備考</th>
                </tr>
            </thead>
            <tbody class="table">
            @php
            $i = 0;
            @endphp
            @foreach($values as $key => $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['id'] }}" name="values[<?php print "$i" ?>][id]" >

                    <td>{{ $value['introducer']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['introducer'] }}" name="values[<?php print "$i" ?>][introducer]">
                   
                    <td>
                        @if($value['vip'] == 0)
                            @php print '-'; @endphp
                        @else
                            @php print '〇'; @endphp
                        @endif
                    </td>
                    <input type="hidden" class="form-control" value="{{ $value['vip'] }}" name="values[<?php print "$i" ?>][vip]" >

                    <td>{{ $value['trader_name'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_name'] }}" name="values[<?php print "$i" ?>][trader_name]">
                
                    <td>
                        @if($value['business_form'] == 0)
                            @php print '法人'; @endphp
                        @else
                            @php print '個人'; @endphp
                        @endif
                    </td>
                    <input type="hidden" class="form-control" value="{{ $value['business_form'] }}" name="values[<?php print "$i" ?>][business_form]">
                
                    <td>{{ $value['trader_email'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_email'] }}" name="values[<?php print "$i" ?>][trader_email]">
                
                    <td>{{ $value['affiliated_company'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['affiliated_company'] }}" name="values[<?php print "$i" ?>][affiliated_company]">
                
                    <td>{{ $value['position'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['position'] }}" name="values[<?php print "$i" ?>][position]">
                
                    <td>{{ $value['trader_zipcode'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_zipcode'] }}" name="values[<?php print "$i" ?>][trader_zipcode]">
                
                    <td>{{ $value['trader_address'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_address'] }}" name="values[<?php print "$i" ?>][trader_address]">
                
                    <td>{{ $value['trader_phone'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_phone'] }}" name="values[<?php print "$i" ?>][trader_phone]">
                
                    <td>{{ $value['trader_phone_2'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_phone_2'] }}" name="values[<?php print "$i" ?>][trader_phone_2]">

                    <td>{{ $value['contract_sending_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['contract_sending_date'] }}" name="values[<?php print "$i" ?>][contract_sending_date]">

                    <td>{{ $value['contract_conclusion_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['contract_conclusion_date'] }}" name="values[<?php print "$i" ?>][contract_conclusion_date]">

                    <td>{{ $value['main_project'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['main_project'] }}" name="values[<?php print "$i" ?>][main_project]">

                    <td>{{ $value['trader_note'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_note'] }}" name="values[<?php print "$i" ?>][trader_note]">
                </tr>
                @php
                $i++;
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-right">
        <input type="submit" value="送信"  class="btn btn-primary">
    </div>
</div>
</form>
@endsection