@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">法人案件顧客リスト編集確認</span>
    </div>

    <div class="enter_check_top">
        <div id="enter_check">以下の内容で修正します</div>
        <div><a class="btn btn-secondary" onclick="history.back()">入力フォーム戻る</a></div>
    </div>

    <!--テーブルカラムにcoment付けてループもありか-->
    <div id="detail_menu">
        <form action="{{ action('MatterController@update') }}" method="POST">
        {{ csrf_field() }}
        @php $authoritys = session()->get('authoritys'); @endphp
        <table class="table table-bordered">
            <input type="hidden" class="form-control" value="{{'☆'}}" name="important">
            <input type="hidden" class="form-control" value="{{'△'}}" name="caution">
            <input type="hidden" class="form-control" name="id" value="{{ $matters['id'] }}">
            <input type="hidden" class="form-control" name="matter_drawing_id" value="{{ $matters['matter_drawing_id'] }}">
            <input type="hidden" class="form-control" name="matter_agreement_id" value="{{ $matters['matter_agreement_id'] }}">
            <input type="hidden" class="form-control" name="matter_insurance_policy_id" value="{{ $matters['matter_insurance_policy_id'] }}">
            <input type="hidden" class="form-control" name="matter_report_id" value="{{ $matters['matter_report_id'] }}">
            <input type="hidden" class="form-control" name="matter_quotation_id" value="{{ $matters['matter_quotation_id'] }}">
            <input type="hidden" class="form-control" name="matter_certification_id" value="{{ $matters['matter_certification_id'] }}">

            <tr>
                <td colspan="2"><h4>＜案件情報＞</h4></td>
            </tr>

            <tr>
                <th>流入経路</th>
                <td>{{$matters["advertising_name"]}}</td>
                <input type="hidden" value="{{ $advertising_id ['id'] }}" name="advertising_id">
            </tr>
            <tr>
                <th>ID</th>
                <td>{{$matters["member"]}}</td>
                <input type="hidden" value="{{ $matters['member'] }}" name="member">
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
                <td>{{$matters["address"]}}</td>
                <input type="hidden" value="{{ $matters['address'] }}" name="address">
            </tr>
            <tr>
                <th>物件名</th>
                <td>{{ $matters['buildingname'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['buildingname'] }}" name="buildingname">
            </tr>
            <tr>
                <th>建物種別</th>
                <td>{{ $matters['property_information'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['property_information'] }}" name="property_information">
            </tr>
            <tr>
                <th>連絡先</th>
                <td>{{ $matters['contact_method'] }}</td>
                <input type="hidden" value="{{ $matters['contact_method'] }}" name="contact_method">
            </tr>
            <tr>
                <th>築年数</th>
                <td>{{$matters["building_age"]}}</td>
                <input type="hidden" value="{{ $matters['building_age'] }}" name="building_age">
            </tr>
            <tr>
                <th>保険会社</th>
                <td>{{$matters["insurance_company"]}}</td>
                <input type="hidden" value="{{ $matters['insurance_company'] }}" name="insurance_company">
            </tr>
            <tr>
                <th>ステータス</th>
                <td>{{ $status_id["status_number"] }}:{{ $matters["status_name"] }}</td>
                <input type="hidden" value="{{ $status_id['id'] }}" name="matter_status_id">
            </tr>
            <tr>
                <th>アクション日付</th>
                <td>{{ $matters["action_date"] }}</td>
                <input type="hidden" value="{{ $matters['action_date'] }}" name="action_date">
            </tr>
            <tr>
                <th>アクション内容</th>
                <td>{{ $matters["action_note"] }}</td>
                <input type="hidden" value="{{ $matters['action_note'] }}" name="action_note">
            </tr>
            <tr>
                <th>備考</th>
                <td>{{$matters["note"]}}</td>
                <input type="hidden" value="{{ $matters['note'] }}" name="note">
            </tr>
            <tr>
                <th>入金予測時期</th>
                <td>{{ $matters["payment_predict_date"] }}</td>
                <input type="hidden" value="{{ $matters['payment_predict_date'] }}" name="payment_predict_date">
            </tr>
            <tr>
                <th>入金期待値</th>
                <td>{{ $matters["payment_expecte"] }}</td>
                <input type="hidden" value="{{ $matters['payment_expecte'] }}" name="payment_expecte">
            </tr>

            <tr>
                <td colspan="2"><h4>＜保険申請進捗＞</h4></td>
            </tr>

            <tr>
                <th>営業担当</th>
                <td>{{$matters["sales_staff"]}}</td>
                <input type="hidden" value="{{ $matters['sales_staff'] }}" name="sales_staff">
            </tr>
            <tr>
                <th>調査会社</th>
                <td>{{ $matters['survey_name'] }}</td>
                <input type="hidden" value="{{ $survey_id['id'] }}" name="survey_id">
            </tr>
            <tr>
                <th>現調担当</th>
                <td>{{ $matters["survey_staff"] }}</td>
                <input type="hidden" value="{{ $matters['survey_staff'] }}" name="survey_staff">
            </tr>
            <tr>
                <th>依頼日</th>
                <td>{{ $matters["request_date"] }}</td>
                <input type="hidden" value="{{ $matters['request_date'] }}" name="request_date">
            </tr>
            <tr>
                <th>現調予定日</th>
                <td>{{ $matters["scheduled_survey_date"] }}</td>
                <input type="hidden" value="{{ $matters['scheduled_survey_date'] }}" name="scheduled_survey_date">
            </tr>
            <tr>
                <th>現調日</th>
                <td>{{ $matters["survey_date"] }}</td>
                <input type="hidden" value="{{ $matters['survey_date'] }}" name="survey_date">
            </tr>
            <tr>
                <th>合意書</th>
                <td>{{ $matters["agreement_date"] }}</td>
                <input type="hidden" value="{{ $matters['agreement_date'] }}" name="agreement_date">
            </tr>
            <tr>
                <th>事故報告日</th>
                <td>{{ $matters["accident_date"] }}</td>
                <input type="hidden" value="{{ $matters['accident_date'] }}" name="accident_date">
            </tr>
            <tr>
                <th>保険申請日</th>
                <td>{{ $matters["insurance_policy_date"] }}</td>
                <input type="hidden" value="{{ $matters['insurance_policy_date'] }}" name="insurance_policy_date">
            </tr>
            <tr>
                <th>認定日</th>
                <td>{{ $matters["certification_date"] }}</td>
                <input type="hidden" value="{{ $matters['certification_date'] }}" name="certification_date">
            </tr>
            <tr>
                <th>請求日</th>
                <td>{{ $matters["bill_issue_date"] }}</td>
                <input type="hidden" value="{{ $matters['bill_issue_date'] }}" name="bill_issue_date">
            </tr>
            <tr>
                <th>入金日</th>
                <td>{{ $matters["payment_date"] }}</td>
                <input type="hidden" value="{{ $matters['payment_date'] }}" name="payment_date">
            </tr>

            <tr>
                <th>見積額</th>
                <td>{{ number_format($matters["quotation_money"]) }}円</td>
                <input type="hidden" value="{{ $matters['quotation_money'] }}" name="quotation_money">
            </tr>
            <tr>
                <th>認定額</th>
                <td>{{ number_format($matters["certification_money"]) }}円</td>
                <input type="hidden" value="{{ $matters['certification_money'] }}" name="certification_money">
            </tr>
            <tr>
                <th>見積額の認定率（％）</th>
                <td>{{ $certification_money_probability }}％</td>
                <input type="hidden" value="{{ $certification_money_probability }}" name="certification_money_probability">
            </tr>
            <tr>
                <th>請求手数料（％）</th>
                <td>{{ $matters["fee"] }}％</td>
                <input type="hidden" value="{{ $matters['fee'] }}" name="fee">
            </tr>
            <tr>
                <th>入金額</th>
                <td>{{ number_format($payment_money) }}円</td>
                <input type="hidden" value="{{ $payment_money }}" name="payment_money">
            </tr>
            <tr>
                <th>調査会社手数料（％）</th>
                <td>{{ $matters["survey_referral"] }}％</td>
                <input type="hidden" value="{{ $matters['survey_referral'] }}" name="survey_referral">
            </tr>
            <tr>
                <th>調査会社支払額</th>
                <td>{{ number_format($survey_payment_money) }}円</td>
                <input type="hidden" value="{{ $survey_payment_money }}" name="survey_payment_money">
            </tr>
            <tr>
                <th>取次店1</th>
                <td>{{ $trader_id }}:{{ $trader_name }}</td>
                <input type="hidden" class="form-control" value="{{ $trader_id }}" name="trader_id">
            </tr>
            <tr>
                <th>紹介率1</th>
                <td>{{ $matters['referral_rate'] }}%</td>
                <input type="hidden" class="form-control" value="{{ $matters['referral_rate'] }}" name="referral_rate">
            </tr>
            <tr>
                <th>取次店支払額1</th>
                <td>{{ number_format($trader_payment_money_1) }}円</td>
                <input type="hidden" value="{{ $trader_payment_money_1 }}" name="trader_payment_money_1">
            </tr>
            <tr>
                <th>取次店2</th>
                <td>{{ $agency_store_2_id }}:{{ $agency_store_2_name }}</td>
                <input type="hidden" class="form-control" value="{{ $agency_store_2_id }}" name="agency_store_2">
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
                <th>取次店3</th>
                <td>{{ $agency_store_3_id }}:{{ $agency_store_3_name }}</td>
                <input type="hidden" class="form-control" value="{{ $agency_store_3_id }}" name="agency_store_3">
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

            <tr>
                <td colspan="2"><h4>＜証券データ＞</h4></td>
            </tr>

            <tr>
                <th>保険証券データタイトル</th>
                <td>{{ $matters['insurance_policy_title'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['insurance_policy_title'] }}" name="insurance_policy_title">
            </tr>
            <tr>
                <th>保険証券データ</th>
                <td><img src="{{ url($insurance_policy_read_path) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                <input type="hidden" class="form-control" value="{{ $insurance_policy_read_path }}" name="insurance_policy_read_path">
            </tr>
            <tr>
                <th>合意書データタイトル</th>
                <td>{{ $matters['agreement_title'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['agreement_title'] }}" name="agreement_title">
            </tr>
            <tr>
                <th>合意書データ</th>
                <td><img src="{{ url($agreement_read_path) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                <input type="hidden" class="form-control" value="{{ $agreement_read_path }}" name="agreement_read_path">
            </tr>
            <tr>
                <th>報告書データタイトル</th>
                <td>{{ $matters['report_title'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['report_title'] }}" name="report_title">
            </tr>
            <tr>
                <th>報告書データ</th>
                <td>
                    <img src="{{ url($report_read_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                    <input type="hidden" class="form-control" value="{{ $report_read_path }}" name="report_read_path">
                </td>
            </tr>
            <tr>
                <th>見積書データタイトル</th>
                <td>{{ $matters['quotation_title'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['quotation_title'] }}" name="quotation_title">
            </tr>
            <tr>
                <th>見積書データ</th>
                <td>
                    <img src="{{ url($quotation_read_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                    <input type="hidden" class="form-control" value="{{ $quotation_read_path }}" name="quotation_read_path">
                </td>
            </tr>
            <tr>
                <th>認定書データタイトル</th>
                <td>{{ $matters['certification_title'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['certification_title'] }}" name="certification_title">
            </tr>
            <tr>
                <th>認定書データ</th>
                <td><img src="{{ url($certification_read_path) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                <input type="hidden" class="form-control" value="{{ $certification_read_path }}" name="certification_read_path">
            </tr>
            <tr>
                <th>請求書データタイトル</th>
                <td>{{ $matters['bill_issue_title'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['bill_issue_title'] }}" name="bill_issue_title">
            </tr>
            <tr>
                <th>請求書データ</th>
                <td>
                    <img src="{{ url($bill_issue_read_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                    <input type="hidden" class="form-control" value="{{ $bill_issue_read_path }}" name="bill_issue_read_path">
                </td>
            </tr>
            <tr>
                <th>その他データタイトル</th>
                <td>{{ $matters['drawing_title'] }}</td>
                <input type="hidden" class="form-control" value="{{ $matters['drawing_title'] }}" name="drawing_title">
            </tr>
            <tr>
                <th>その他データ</th>
                <td><img src="{{ url($drawing_read_path) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                <input type="hidden" class="form-control" value="{{ $drawing_read_path }}" name="drawing_read_path">
            </tr>
        </table>

        <div class="text-right">
            <input type="submit" value="修正" class="btn btn-info">
        </div>

        </form>
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
    </div>
@endsection