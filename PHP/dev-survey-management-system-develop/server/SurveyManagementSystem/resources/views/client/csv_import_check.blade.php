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

    <form action="{{ action('ClientController@csv_import_add') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div>
            @php $authoritys = session()->get('authoritys'); @endphp
            <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th>連結日</th>
                    <th>流入フラグ</th>
                    <th>ID</th>
                    <th>氏名</th>
                    <th>住所</th>
                    <th>物件名</th>
                    <th>連絡先</th>
                    <th>メールアドレス</th>
                    <th>火災保険の加入状況</th>
                    <th>保険会社</th>
                    <th>築年数</th>
                    <th>地震 有/無</th>
                    <th>現状ST</th>
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
                    <th>事故報告</th>
                    <th>保険申請日</th>
                    <th>認定日</th>
                    <th>請求日</th>
                    <th>入金日</th>
                    <th>クオカード送付日</th>
                    <th>見積額</th>
                    <th>認定額</th>
                    <th>見積額の認定率</th>
                    <th>請求手数料（％）</th>
                    <th>入金額</th>
                    <th>調査会社手数料（％）</th>
                    <th>調査会社支払額</th>
                    <th>取次店手数料（％）</th>
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
                    <td>{{ $value['advertising'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][advertising]" value="{{ $value['advertising'] }}">
                    <td>{{ $value['member'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][member]" value="{{ $value['member'] }}">
                    <td>{{ $value['contractor'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][contractor]" value="{{ $value['contractor'] }}">
                    <td>{{ $value['address'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][address]" value="{{ $value['address'] }}">
                    <td>{{ $value['buildingname'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][buildingname]" value="{{ $value['buildingname'] }}">
                    <td>{{ $value['contractor_contact'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][contractor_contact]" value="{{ $value['contractor_contact'] }}">
                    <td>{{ $value['mail_address'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][mail_address]" value="{{ $value['mail_address'] }}">
                    <td>{{ $value['fire_insurance_flg'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][fire_insurance_flg]" value="{{ $value['fire_insurance_flg'] }}">
                    <td>{{ $value['insurance_company'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][insurance_company]" value="{{ $value['insurance_company'] }}">
                    <td>{{ $value['building_age'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][building_age]" value="{{ $value['building_age'] }}">
                    <td>{{ $value['earthquake_flg'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][earthquake_flg]" value="{{ $value['earthquake_flg'] }}">
                    <td>{{ $value['status_name'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][status_name]" value="{{ $value['status_name'] }}">
                    <td>{{ $value['action_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][action_date]" value="{{ $value['action_date'] }}">
                    <td>{{ $value['action_note'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][action_note]" value="{{ $value['action_note'] }}">
                    <td>{{ $value['note'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][note]" value="{{ $value['note'] }}">
                    <td>{{ $value['payment_predict_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][payment_predict_date]" value="{{ $value['payment_predict_date'] }}">
                    <td>{{ $value['payment_expecte'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][payment_expecte]" value="{{ $value['payment_expecte'] }}">
                    <td>{{ $value['sales_staff'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][sales_staff]" value="{{ $value['sales_staff'] }}">
                    <td>{{ $value['survey_name'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][survey_name]" value="{{ $value['survey_name'] }}">
                    <td>{{ $value['survey_staff'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][survey_staff]" value="{{ $value['survey_staff'] }}">
                    <td>{{ $value['request_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][request_date]" value="{{ $value['request_date'] }}">
                    <td>{{ $value['scheduled_survey_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][scheduled_survey_date]" value="{{ $value['scheduled_survey_date'] }}">
                    <td>{{ $value['survey_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][survey_date]" value="{{ $value['survey_date'] }}">
                    <td>{{ $value['agreement_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][agreement_date]" value="{{ $value['agreement_date'] }}">
                    <td>{{ $value['accident_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][accident_date]" value="{{ $value['accident_date'] }}">
                    <td>{{ $value['insurance_policy_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][insurance_policy_date]" value="{{ $value['insurance_policy_date'] }}">
                    <td>{{ $value['certification_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][certification_date]" value="{{ $value['certification_date'] }}">
                    <td>{{ $value['bill_issue_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][bill_issue_date]" value="{{ $value['bill_issue_date'] }}">
                    <td>{{ $value['payment_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][payment_date]" value="{{ $value['payment_date'] }}">
                    <td>{{ $value['quo_card_date'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][quo_card_date]" value="{{ $value['quo_card_date'] }}">
                    <td>{{ $value['quotation_money'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][quotation_money]" value="{{ $value['quotation_money'] }}">
                    <td>{{ $value['certification_money'] }}</td>
                    <input type="hidden"   name="values[<?php print "$i" ?>][certification_money]" value="{{ $value['certification_money'] }}">
                    <td>{{ $value['certification_money_probability'] }}</td>
                    <input type="hidden"   name="values[<?php print "$i" ?>][certification_money_probability]" value="{{ $value['certification_money_probability'] }}">
                    <td>{{ $value['client_fee'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][client_fee]" value="{{ $value['client_fee'] }}">
                    <td>{{ $value['payment_money'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][payment_money]" value="{{ $value['payment_money'] }}">
                    <td>{{ $value['survey_referral'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][survey_referral]" value="{{ $value['survey_referral'] }}">
                    <td>{{ $value['trader_payment_money'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][trader_payment_money]" value="{{ $value['trader_payment_money'] }}">
                    <td>{{ $value['trader_referral'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][trader_referral]" value="{{ $value['trader_referral'] }}">
                    <td>{{ $value['survey_payment_money'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][survey_payment_money]" value="{{ $value['survey_payment_money'] }}">
                    <td>{{ $value['profit_money'] }}</td>
                    <input type="hidden" name="values[<?php print "$i" ?>][profit_money]" value="{{ $value['profit_money'] }}">

                    <input type="hidden" name="values[<?php print "$i" ?>][user_id]" value="{{ $value['user_id'] }}">
                </tr>
                @php
                $i++;
                @endphp
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-right">
        <input type="submit" value="送信"  class="btn btn-info">
    </div>
</div>
</form>
@endsection

