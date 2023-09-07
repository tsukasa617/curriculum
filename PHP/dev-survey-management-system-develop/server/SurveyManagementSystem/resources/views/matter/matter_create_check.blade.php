@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">案件登録確認</span>
    </div>

    <div class="enter_check_top">
        <div id="enter_check">以下の内容で修正します</div>
        <div><a class="btn btn-secondary" onclick="history.back()">入力フォーム戻る</a></div>
    </div>

    <form action="{{ action('MatterController@create_add') }}" method="POST">
        {{ csrf_field() }}

    <div id="detail_menu">
        <table class="table table-bordered">
            <tr>
                <td colspan="2"><h4>＜案件情報＞</h4></td>
            </tr>
            <tr>
                <th>流入経路</th>
                <td>{{ $matters['advertising_name'] }}</td>
                <input type="hidden" class="form-control" value="{{ $advertising_id['id'] }}" name="advertising_id" required>
            </tr>
            <tr>
                <th>ID</th>
                <td>{{ $matters['member'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['member'] }}" name="member" required>
            </tr>
            <tr>
                <th>グループ名</th>
                <td>{{ $matters['group_name'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['group_name'] }}" name="group_name">
            </tr>
            <tr>
                <th>会社名</th>
                <td>{{ $matters['contractor'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['contractor'] }}" name="contractor" required>
            </tr>
            <tr>
                <th>契約者名</th>
                <td>{{ $matters['insurance_policyholder'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['insurance_policyholder'] }}" name="insurance_policyholder">
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $matters['address'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['address'] }}" name="address" required>
            </tr>
            <tr>
                <th>施設名</th>
                <td>{{ $matters['buildingname'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['buildingname'] }}" name="buildingname">
            </tr>
            <tr>
                <th>建物(名称)</th>
                <td>{{ $matters['property_information'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['property_information'] }}" name="property_information">
            </tr>
            <tr>
                <th>連絡方法</th>
                <td>{{ $matters['contact_method'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['contact_method'] }}" name="contact_method" required>
            </tr>
            <tr>
                <th>台風名</th>
                <td>{{ $matters['typhoon_name'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['typhoon_name'] }}" name="typhoon_name">
            </tr>
            <tr>
                <th>風速</th>
                <td>{{ $matters['wind_speed'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['wind_speed'] }}" name="wind_speed">
            </tr>
            <tr>
                <th>風災</th>
                @if($matters['wind_disaster']  == 0)
                    <td>✖</td>
                @else
                    <td>〇</td>
                @endif
                <input type="hidden" class="form-control" value="{{ $matters['wind_disaster'] }}" name="wind_disaster">
            </tr>
            <tr>
                <th>震災</th>
                @if($matters['earthquake_disaster']  == 0)
                    <td>✖</td>
                @else
                    <td>〇</td>
                @endif
                <input type="hidden" class="form-control" value="{{ $matters['earthquake_disaster'] }}" name="earthquake_disaster">
            </tr>
            <tr>
                <th>保険会社</th>
                <td>{{ $matters['insurance_company'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['insurance_company'] }}" name="insurance_company">
            </tr>
            <tr>
                <th>ステータス</th>
                <td>{{ $matter_statuse_id['status_number'] }}:{{ $matters['status_name'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matter_statuse_id['id'] }}" name="matter_status_id">
            </tr>
            <tr>
                <th>アクション日付</th>
                <td>{{ $matters['action_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['action_date'] }}" name="action_date">
            </tr>
            <tr>
                <th>アクション内容</th>
                <td>{{ $matters['action_note'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['action_note'] }}" name="action_note">
            </tr>
            <tr>
                <th>入金予測時期</th>
                <td>{{ $matters['payment_predict_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['payment_predict_date'] }}" name="payment_predict_date">
            </tr>
            <tr>
                <th>入金期待値</th>
                <td>{{ $matters['payment_expecte'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['payment_expecte'] }}" name="payment_expecte">
            </tr>
            <tr>
                <th>備考</th>
                <td>{{ $matters['note'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['note'] }}" name="note">
            </tr>
            <tr>
                <th>工事コンサル</th>
                @if($matters['construction_consultant']  == 0)
                    <td>コンサル</td>
                @else
                    <td>工事</td>
                @endif
                <input type="hidden" class="form-control" value="{{ $matters['construction_consultant'] }}" name="construction_consultant">
            </tr>
            <tr>
                <th>図面</th>
                @if($matters['drawing']  == 0)
                    <td>-</td>
                @else
                    <td>〇</td>
                @endif
                <input type="hidden" class="form-control" value="{{ $matters['drawing'] }}" name="drawing">
            </tr>
            <tr>
                <th>保険証券</th>
                @if($matters['insurance_policy'] == 0)
                    <td>-</td>
                @else
                    <td>〇</td>
                @endif
                <input type="hidden" class="form-control" value="{{ $matters['insurance_policy'] }}" name="insurance_policy">
            </tr>
            <div class="col-sm-9 content_position" style="margin-top: 15px;">
                <h4>＜保険申請進捗＞</h4>
            </div>
            <tr>
                <th>営業担当</th>
                <td>{{ $matters['sales_staff'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['sales_staff'] }}" name="sales_staff">
            </tr>
            <tr>
                <th>調査会社</th>
                <td>{{ $matters['survey_name' ]}}</td>
                <input type="hidden" class="form-control" value="{{ $survey_id['id'] }}" name="survey_id">
            </tr>
            <tr>
                <th>現調担当</th>
                <td>{{ $matters['survey_staff'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['survey_staff'] }}" name="survey_staff">
            </tr>
            <tr>
                <th>取次店</th>
                <td>{{ $trader_id }}:{{ $trader_name }}</td>
                <input type="hidden" class="form-control" value="{{ $trader_id }}" name="trader_id">
            </tr>
            <tr>
                <th>取次店2</th>
                <td>{{ $agency_store_2_id }}:{{ $agency_store_2_name }}</td>
                <input type="hidden" class="form-control" value="{{ $agency_store_2_id }}" name="agency_store_2">
            </tr>
            <tr>
                <th>取次店3</th>
                <td>{{ $agency_store_3_id }}:{{ $agency_store_3_name }}</td>
                <input type="hidden" class="form-control" value="{{ $agency_store_3_id }}" name="agency_store_3">
            </tr>

            <tr>
                <th>商談日</th>
                <td>{{ $matters['scheduled_survey_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['scheduled_survey_date'] }}" name="scheduled_survey_date">
            </tr>
            <tr>
                <th>依頼日</th>
                <td>{{ $matters['request_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['request_date'] }}" name="request_date">
            </tr>
            <tr>
                <th>現調日</th>
                <td>{{ $matters['survey_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['survey_date'] }}" name="survey_date">
            </tr>
            <tr>
                <th>合意書</th>
                <td>{{ $matters['agreement_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['agreement_date'] }}" name="agreement_date">
            </tr>
            <tr>
                <th>事故報告日</th>
                <td>{{ $matters['accident_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['accident_date'] }}" name="accident_date">
            </tr>
            <tr>
                <th>保険申請日</th>
                <td>{{ $matters['insurance_policy_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['insurance_policy_date'] }}" name="insurance_policy_date">
            </tr>
            <tr>
                <th>認定日</th>
                <td>{{ $matters['certification_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['certification_date'] }}" name="certification_date">
            </tr>
            <tr>
                <th>請求用紙到着（民間）</th>
                <td>{{ $matters['billing_receipt_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['billing_receipt_date'] }}" name="billing_receipt_date">
            </tr>
            <tr>
                <th>請求日</th>
                <td>{{ $matters['bill_issue_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['bill_issue_date'] }}" name="bill_issue_date">
            </tr>
            <tr>
                <th>入金日</th>
                <td>{{ $matters['payment_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['payment_date'] }}" name="payment_date">
            </tr>
            <tr>
                <th>報告書完成日</th>
                <td>{{ $matters['report_completed_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['report_completed_date'] }}" name="report_completed_date">
            </tr>
            <tr>
                <th>見積書完成日</th>
                <td>{{ $matters['quotation_completed_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['quotation_completed_date'] }}" name="quotation_completed_date">
            </tr>
            <tr>
                <th>鑑定日</th>
                <td>{{ $matters['judge_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['judge_date'] }}" name="judge_date">
            </tr>
            <tr>
                <th>発送日</th>
                <td>{{ $matters['submit_sending_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['submit_sending_date'] }}" name="submit_sending_date">
            </tr>
            <tr>
                <th>発送先(保険会社/お客様)</th>
                <td>{{ $matters['document_submit_to'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['document_submit_to'] }}" name="document_submit_to">
            </tr>
            <tr>
                <th>顧客請求書送付<br>(例:10/01)</th>
                <td>{{ $matters['customer_invoice_date'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['customer_invoice_date'] }}" name="customer_invoice_date">
            </tr>

            <tr>
                <th>見積額</th>
                <td>{{ number_format($matters['quotation_money']) }}円</td>
                <input type="hidden" class="form-control" value="{{ $matters['quotation_money'] }}" name="quotation_money">
            </tr>
            <tr>
                <th>認定額</th>
                <td>{{ number_format($matters['certification_money']) }}円</td>
                <input type="hidden" class="form-control" value="{{ $matters['certification_money'] }}" name="certification_money">
            </tr>
            <tr>
                <th>見積額の認定率(%)</th>
                <td>{{ $certification_money_probability }}%</td>
                <input type="hidden" class="form-control" value="{{ $certification_money_probability }}" name="certification_money_probability">
            </tr>
            <tr>
                <th>請求手数料(%)</th>
                <td>{{ $matters['fee'] }}%</td>
                <input type="hidden" class="form-control" value="{{ $matters['fee'] }}" name="fee">
            </tr>
            <tr>
                <th>入金額</th>
                <td>{{ number_format($payment_money) }}円</td>
                <input type="hidden" class="form-control" value="{{ $payment_money }}" name="payment_money">
            </tr>
            <tr>
                <th>調査会社手数料(%)</th>
                <td>{{ $matters['survey_referral'] }}%</td>
                <input type="hidden" class="form-control" value="{{ $matters['survey_referral'] }}" name="survey_referral">
            </tr>
            <tr>
                <th>調査会社支払い額</th>
                <td>{{ number_format($survey_payment_money) }}円</td>
                <input type="hidden" class="form-control" value="{{ $survey_payment_money }}" name="survey_payment_money">
            </tr>
            <tr>
                <th>紹介率</th>
                <td>{{ $matters['referral_rate'] }}%</td>
                <input type="hidden" class="form-control" value="{{ $matters['referral_rate'] }}" name="referral_rate">
            </tr>
            <tr>
                <th>取次店支払額1</th>
                <td>{{ number_format($trader_payment_money_1) }}円</td>
                <input type="hidden" value="{{ $trader_payment_money_1 }}" name="trader_payment_money_1">
            </tr>
            <tr>
                <th>紹介率2</th>
                <td>{{ $matters['referral_rate_2'] }}%</td>
                <input type="hidden" class="form-control" value="{{ $matters['referral_rate_2'] }}" name="referral_rate_2">
            </tr>
            <tr>
                <th>取次店支払額2</th>
                <td>{{ number_format($trader_payment_money_2) }}円</td>
                <input type="hidden" value="{{ $trader_payment_money_2 }}" name="trader_payment_money_2">
            </tr>
            <tr>
                <th>紹介率3</th>
                <td>{{ $matters['referral_rate_3'] }}%</td>
                <input type="hidden" class="form-control" value="{{ $matters['referral_rate_3'] }}" name="referral_rate_3">
            </tr>
            <tr>
                <th>取次店支払額3</th>
                <td>{{ number_format($trader_payment_money_3) }}円</td>
                <input type="hidden" value="{{ $trader_payment_money_3 }}" name="trader_payment_money_3">
            </tr>
            <tr>
                <th>紹介率合計</th>
                <td>{{ $referral_rate_total }}%</td>
                <input type="hidden" class="form-control" value="{{ $referral_rate_total }}" name="referral_rate_total">
            </tr>
            <tr>
                <th>取次店支払額</th>
                <td>{{ number_format($trader_payment_money) }}円</td>
                <input type="hidden" value="{{ $trader_payment_money }}" name="trader_payment_money">
            </tr>
            <tr>
                <th>利益額</th>
                <td>{{ number_format($profit_money) }}円</td>
                <input type="hidden" value="{{ $profit_money }}" name="profit_money">
            </tr>

            <input type="hidden" class="form-control" value="{{'☆'}}" name="important">
            <input type="hidden" class="form-control" value="{{'△'}}" name="caution">
            <input type="hidden" class="form-control" value="{{ $user_id['id'] }}" name="user_id">
            <input type="hidden" class="form-control" value="{{'1'}}" name="matter_drawing_id">
            <input type="hidden" class="form-control" value="{{'1'}}" name="matter_agreement_id">
            <input type="hidden" class="form-control" value="{{'1'}}" name="matter_insurance_policy_id">
            <input type="hidden" class="form-control" value="{{'1'}}" name="matter_report_id">
            <input type="hidden" class="form-control" value="{{'1'}}" name="matter_quotation_id">
            <input type="hidden" class="form-control" value="{{'1'}}" name="matter_certification_id">
            <input type="hidden" class="form-control" value="{{'1'}}" name="matter_bill_issue_id">
            
        </table>
        <div id="page_top"><a href="#">TOP</a></div>
        
        <!-- トップへ戻るボタンのスクリプト -->
        <script>
            $(function(){
                var pagetop = $('#page_top');
                // ボタン非表示
                pagetop.hide();
                // 100px スクロールしたらボタン表示
                $(window).scroll(function () {
                   if ($(this).scrollTop() > 100) {
                        pagetop.fadeIn();
                   } else {
                        pagetop.fadeOut();
                   }
                });
                pagetop.click(function () {
                   $('body, html').animate({ scrollTop: 0 }, 500);
                   return false;
                });
              });
        </script>

        <div class="text-right">
            <button type="button" class="btn btn-secondary" onclick="history.back()">入力フォームへ戻る</button>
            <input type="submit" value="登録" class="btn btn-info">
        </div>

        </form>
    </div>
@endsection