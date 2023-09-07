@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">CSVファイルインポート</span>
    </div>

    <div class="text-right">
        <button onclick=history.back() class="btn btn-secondary" style="margin-bottom:10px;">ファイル選択に戻る</button>
    </div>
    <form action="{{ action('MatterController@csv_import_add') }}" method="POST">
    {{ csrf_field() }}
    <div>
        @php $authoritys = session()->get('authoritys'); @endphp
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th>連結日</th>
                    <th>流入経路</th>
                    <th>ID</th>
                    <th>グループ名</th>
                    <th>会社名</th>
                    <th>契約者名</th>
                    <th>住所</th>
                    <th>建物名</th>
                    <th>建物種別</th>
                    <th>連絡先</th>
                    <th>築年数</th>
                    <th>保険会社</th>
                    <th>ステータス</th>
                    <th>アクション日付</th>
                    <th>アクション内容</th>
                    <th>備考</th>
                    <th>入金予測時期</th>
                    <th>入金期待値</th>
                    <th>営業担当</th>
                    <th>調査会社</th>
                    <th>現調担当</th>
                    <th>依頼日</th>
                    <th>現調予定日</th>
                    <th>現調日</th>
                    <th>合意書</th>
                    <th>事故報告日</th>
                    <th>保険申請日</th>
                    <th>認定日</th>
                    <th>請求日</th>
                    <th>入金日</th>
                    <th>見積額</th>
                    <th>認定額</th>
                    <th>見積額の認定率（％）</th>
                    <th>請求手数料（％）</th>
                    <th>入金額</th>
                    <th>調査会社手数料（％）</th>
                    <th>調査会社支払額</th>
                    <th>取次店1</th>
                    <th>紹介率1</th>
                    <th>取次店支払額1</th>
                    <th>取次店2</th>
                    <th>紹介率2</th>
                    <th>取次店支払額2</th>
                    <th>取次店3</th>
                    <th>紹介率3</th>
                    <th>取次店支払額3</th>
                    <th>紹介率合計</th>
                    <th>取次店支払額</th>
                    <th>利益額</th>
                </tr>
            </thead>
            <tbody class="table">
            @php
            $i = 0;
            @endphp
            @foreach($values as $key => $value)
                <tr>
                    <td>{{ $value['submit_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][submit_date]" value="{{ $value['submit_date'] }}">
                    <td>{{ $value['advertising_name'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['advertising_name'] }}" name="values[<?php print "$i" ?>][advertising_name]">
                    <td>{{ $value['member'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['member'] }}" name="values[<?php print "$i" ?>][member]">
                    <td>{{ $value['group_name'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['group_name'] }}" name="values[<?php print "$i" ?>][group_name]">
                    <td>{{ $value['contractor'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['contractor'] }}" name="values[<?php print "$i" ?>][contractor]">
                    <td>{{ $value['insurance_policyholder'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['insurance_policyholder'] }}" name="values[<?php print "$i" ?>][insurance_policyholder]">
                    <td>{{ $value['address'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['address'] }}" name="values[<?php print "$i" ?>][address]">
                    <td>{{ $value['buildingname'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['buildingname'] }}" name="values[<?php print "$i" ?>][buildingname]">
                    <td>{{ $value['property_information'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['property_information'] }}" name="values[<?php print "$i" ?>][property_information]">
                    <td>{{ $value['contact_method'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['contact_method'] }}" name="values[<?php print "$i" ?>][contact_method]">
                    <td>{{ $value['building_age']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['building_age'] }}" name="values[<?php print "$i" ?>][building_age]">
                    <td>{{ $value['insurance_company'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['insurance_company'] }}" name="values[<?php print "$i" ?>][insurance_company]">
                    <td>{{ $value['status_name'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['status_name'] }}" name="values[<?php print "$i" ?>][status_name]">
                    <td>{{ $value['action_date']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['action_date'] }}" name="values[<?php print "$i" ?>][action_date]">
                    <td>{{ $value['action_note']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['action_note'] }}" name="values[<?php print "$i" ?>][action_note]">
                    <td>{{ $value['note'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['note'] }}" name="values[<?php print "$i" ?>][note]">
                    <td>{{ $value['payment_predict_date']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['payment_predict_date'] }}" name="values[<?php print "$i" ?>][payment_predict_date]">
                    <td>{{ $value['payment_expecte']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['payment_expecte'] }}" name="values[<?php print "$i" ?>][payment_expecte]">
                    <td>{{ $value['sales_staff']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['sales_staff'] }}" name="values[<?php print "$i" ?>][sales_staff]">
                    <td>{{ $value['survey_name']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['survey_name'] }}" name="values[<?php print "$i" ?>][survey_name]">
                    <td>{{ $value['survey_staff']}}</td>
                    <input type="hidden" class="form-control" value="{{ $value['survey_staff'] }}" name="values[<?php print "$i" ?>][survey_staff]">
                    <td>{{ $value['request_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['request_date'] }}" name="values[<?php print "$i" ?>][request_date]">
                    <td>{{ $value['scheduled_survey_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['scheduled_survey_date'] }}" name="values[<?php print "$i" ?>][scheduled_survey_date]">
                    <td>{{ $value['survey_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['survey_date'] }}" name="values[<?php print "$i" ?>][survey_date]">
                    <td>{{ $value['agreement_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['agreement_date'] }}" name="values[<?php print "$i" ?>][agreement_date]">
                    <td>{{ $value['accident_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['accident_date'] }}" name="values[<?php print "$i" ?>][accident_date]">
                    <td>{{ $value['insurance_policy_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['insurance_policy_date'] }}" name="values[<?php print "$i" ?>][insurance_policy_date]">
                    <td>{{ $value['certification_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['certification_date'] }}" name="values[<?php print "$i" ?>][certification_date]">
                    <td>{{ $value['bill_issue_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['bill_issue_date'] }}" name="values[<?php print "$i" ?>][bill_issue_date]">
                    <td>{{ $value['payment_date'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['payment_date'] }}" name="values[<?php print "$i" ?>][payment_date]">
                    <td>¥{{ number_format($value['quotation_money']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['quotation_money'] }}" name="values[<?php print "$i" ?>][quotation_money]">
                    <td>{{ number_format($value['certification_money']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['certification_money'] }}" name="values[<?php print "$i" ?>][certification_money]">
                    <td>{{ $value['quotation_money_probability'] }}％</td>
                    <input type="hidden" class="form-control" value="{{ $value['quotation_money_probability'] }}" name="values[<?php print "$i" ?>][quotation_money_probability]">
                    <td>{{ $value['fee'] }}%</td>
                    <input type="hidden" class="form-control" value="{{ $value['fee'] }}" name="values[<?php print "$i" ?>][fee]">
                    <td>{{ number_format($value['payment_money']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['payment_money'] }}" name="values[<?php print "$i" ?>][payment_money]">
                    <td>{{ $value['survey_referral'] }}％</td>
                    <input type="hidden" class="form-control" value="{{ $value['survey_referral'] }}" name="values[<?php print "$i" ?>][survey_referral]">
                    <td>{{ number_format($value['survey_payment_money']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['survey_payment_money'] }}" name="values[<?php print "$i" ?>][survey_payment_money]">
                    <td>{{ $value['trader_name'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_name'] }}" name="values[<?php print "$i" ?>][trader_name]">
                    <td>{{ $value['referral_rate'] }}％</td>
                    <input type="hidden" class="form-control" value="{{ $value['referral_rate'] }}" name="values[<?php print "$i" ?>][referral_rate]">
                    <td>{{ number_format($value['trader_payment_money_1']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_payment_money_1'] }}" name="values[<?php print "$i" ?>][trader_payment_money_1]">
                    <td>{{ $value['agency_store_2_name'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['agency_store_2_name'] }}" name="values[<?php print "$i" ?>][agency_store_2_name]">
                    <td>{{ $value['referral_rate_2'] }}％</td>
                    <input type="hidden" class="form-control" value="{{ $value['referral_rate_2'] }}" name="values[<?php print "$i" ?>][referral_rate_2]">
                    <td>{{ number_format($value['trader_payment_money_2']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_payment_money_2'] }}" name="values[<?php print "$i" ?>][trader_payment_money_2]">
                    <td>{{ $value['agency_store_3_name'] }}</td>
                    <input type="hidden" class="form-control" value="{{ $value['agency_store_3_name'] }}" name="values[<?php print "$i" ?>][agency_store_3_name]">
                    <td>{{ $value['referral_rate_3'] }}%</td>
                    <input type="hidden" class="form-control" value="{{ $value['referral_rate_3'] }}" name="values[<?php print "$i" ?>][referral_rate_3]">
                    <td>{{ number_format($value['trader_payment_money_3']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_payment_money_3'] }}" name="values[<?php print "$i" ?>][trader_payment_money_3]">
                    <td>{{ $value['referral_rate_total'] }}％</td>
                    <input type="hidden" class="form-control" value="{{ $value['referral_rate_total'] }}" name="values[<?php print "$i" ?>][referral_rate_total]">
                    <td>{{ number_format($value['trader_payment_money']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['trader_payment_money'] }}" name="values[<?php print "$i" ?>][trader_payment_money]">
                    <td>{{ number_format($value['profit_money']) }}円</td>
                    <input type="hidden" class="form-control" value="{{ $value['profit_money'] }}" name="values[<?php print "$i" ?>][profit_money]">

                    <input type="hidden" class="form-control" value="{{ $value['user_id'] }}" name="values[<?php print "$i" ?>][user_id]">
                </tr>
                @php
                $i++;
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-right">
        <input type="submit" value="送信"  class="btn btn-primary" >
    </div>
</div>
</form>
@endsection

