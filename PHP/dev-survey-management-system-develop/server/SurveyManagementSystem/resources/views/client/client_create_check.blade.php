@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">

    <div>
        <span style="font-size: 30px;">個人顧客情報登録確認</span>
    </div>

    <div class="enter_check_top">
        <div id="enter_check">以下の内容で修正します</div>
        <div><a class="btn btn-secondary" onclick="history.back()">入力フォーム戻る</a></div>
    </div>

    <form action="{{ action('ClientController@create_add') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div id="detail_menu">
            <table class="table table-bordered">
                <tr>
                    <td colspan="2"><h4>＜案件情報＞</h4></td>
                </tr>
                <tr>
                    <th>流入フラグ</th>
                    @if(is_numeric($clients['advertising']))
                        <td>{{ $trader_name['trader_name'] }}</td>
                    @else
                        <td>{{ $clients["advertising"] }}</td>
                    @endif
                    <input type="hidden" value="{{ $clients['advertising'] }}" name="advertising">
                </tr>
                <tr>
                    <th>ID</th>
                    <td>{{ $clients["member"] }}</td>
                    <input type="hidden" value="{{ $clients['member'] }}" name="member">
                </tr>
                <tr>
                    <th>氏名</th>
                    <td>{{ $clients["contractor"] }}</td>
                    <input type="hidden" value="{{ $clients['contractor'] }}" name="contractor">
                </tr>
                <tr>
                    <th>住所</th>
                    <td>{{ $clients["address"] }}</td>
                    <input type="hidden" value="{{ $clients['address'] }}" name="address">
                </tr>
                <tr>
                    <th>物件名</th>
                    <td>{{ $clients["buildingname"] }}</td>
                    <input type="hidden" value="{{ $clients['buildingname'] }}" name="buildingname">
                </tr>
                <tr>
                    <th>連絡先</th>
                    <td>{{ $contractor_contact }}</td>
                    <input type="hidden" value="{{ $clients['contractor_contact'] }}" name="contractor_contact">
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>{{ $clients["mail_address"] }}</td>
                    <input type="hidden" value="{{ $clients['mail_address'] }}" name="mail_address">
                </tr>
                <tr>
                    <th>火災保険の加入状況</th>
                    <td>
                        @if($clients["fire_insurance_flg"] == '0')
                            @php print '未加入'; @endphp
                        @elseif($clients["fire_insurance_flg"] == '1')
                            @php print '加入している'; @endphp
                        @else
                            @php print ''; @endphp
                        @endif
                    </td>
                    <input type="hidden" value="{{ $clients['fire_insurance_flg'] }}" name="fire_insurance_flg">
                </tr>
                <tr>
                    <th>保険会社</th>
                    <td>{{ $clients["insurance_company"] }}</td>
                    <input type="hidden" value="{{ $clients['insurance_company'] }}" name="insurance_company">
                </tr>
                <tr>
                    <th>築年数</th>
                    <td>{{ $clients["building_age"] }}</td>
                    <input type="hidden" value="{{ $clients['building_age'] }}" name="building_age">
                </tr>
                <tr>
                    <th>地震 有/無</th>
                        @if($clients['earthquake_flg'] == 0)
                            <td>無</td>
                        @else
                            <td>有</td>
                        @endif
                    <input type="hidden" value="{{ $clients['earthquake_flg'] }}" name="earthquake_flg">
                </tr>
                <tr>
                    <th>ステータス</th>
                    <td>{{ $client_status_id["status_number"] }}:{{ $client_status_id["status_name"] }}</td>
                    <input type="hidden" value="{{ $client_status_id['id'] }}" name="client_status_id">
                </tr>
                <tr>
                    <th>アクション日付</th>
                    <td>{{ $clients["action_date"] }}</td>
                    <input type="hidden" value="{{ $clients['action_date'] }}" name="action_date">
                </tr>
                <tr>
                    <th>アクション内容</th>
                    <td>{{ $clients["action_note"] }}</td>
                    <input type="hidden" value="{{ $clients['action_note'] }}" name="action_note">
                </tr>
                <tr>
                    <th>備考</th>
                    <td>{{ $clients["note"] }}</td>
                    <input type="hidden" value="{{ $clients['note'] }}" name="note">
                </tr>
                <tr>
                    <th>入金予測時期</th>
                    <td>{{ $clients["payment_predict_date"] }}</td>
                    <input type="hidden" value="{{ $clients['payment_predict_date'] }}" name="payment_predict_date">
                </tr>
                <tr>
                    <th>入金期待値</th>
                    <td>{{ $clients["payment_expecte"] }}</td>
                    <input type="hidden" value="{{ $clients['payment_expecte'] }}" name="payment_expecte">
                </tr>

                <tr>
                    <td colspan="2"><h4>＜保険申請進捗＞</h4></td>
                </tr>

                <tr>
                    <th>営業担当</th>
                    <td>{{ $clients["sales_staff"] }}</td>
                    <input type="hidden" value="{{ $clients['sales_staff'] }}" name="sales_staff">
                </tr>
                <tr>
                    <th>調査会社</th>
                    <td>{{ $clients['survey_name'] }}</td>
                    <input type="hidden" value="{{ $survey_id['id'] }}" name="survey_id">
                </tr>
                <tr>
                    <th>現調担当</th>
                    <td>{{ $clients["survey_staff"] }}</td>
                    <input type="hidden" value="{{ $clients['survey_staff'] }}" name="survey_staff">
                </tr>
                <tr>
                    <th>依頼日</th>
                    <td>{{ $clients["request_date"] }}</td>
                    <input type="hidden" value="{{ $clients['request_date'] }}" name="request_date">
                </tr>
                <tr>
                    <th>現調予定日</th>
                    <td>{{ $clients["scheduled_survey_date"] }}</td>
                    <input type="hidden" value="{{ $clients['scheduled_survey_date'] }}" name="scheduled_survey_date">
                </tr>
                <tr>
                    <th>現調日</th>
                    <td>{{ $clients["survey_date"] }}</td>
                    <input type="hidden" value="{{ $clients['survey_date'] }}" name="survey_date">
                </tr>
                <tr>
                    <th>合意書</th>
                    <td>{{ $clients["agreement_date"] }}</td>
                    <input type="hidden" value="{{ $clients['agreement_date'] }}" name="agreement_date">
                </tr>
                <tr>
                    <th>事故報告日</th>
                    <td>{{ $clients["accident_date"] }}</td>
                    <input type="hidden" value="{{ $clients['accident_date'] }}" name="accident_date">
                </tr>
                <tr>
                    <th>保険申請日</th>
                    <td>{{ $clients["insurance_policy_date"] }}</td>
                    <input type="hidden" value="{{ $clients['insurance_policy_date'] }}" name="insurance_policy_date">
                </tr>
                <tr>
                    <th>認定日</th>
                    <td>{{ $clients["certification_date"] }}</td>
                    <input type="hidden" value="{{ $clients['certification_date'] }}" name="certification_date">
                </tr>
                <tr>
                    <th>請求日</th>
                    <td>{{ $clients["bill_issue_date"] }}</td>
                    <input type="hidden" value="{{ $clients['bill_issue_date'] }}" name="bill_issue_date">
                </tr>
                <tr>
                    <th>入金日</th>
                    <td>{{ $clients["payment_date"] }}</td>
                    <input type="hidden" value="{{ $clients['payment_date'] }}" name="payment_date">
                </tr>
                <tr>
                    <th>クオカード送付日</th>
                    <td>{{ $clients["quo_card_date"] }}</td>
                    <input type="hidden" value="{{ $clients['quo_card_date'] }}" name="quo_card_date">
                </tr>

                <tr>
                    <th>見積額</th>
                    <td>{{ number_format($clients["quotation_money"]) }}円</td>
                    <input type="hidden" value="{{ $clients['quotation_money'] }}" name="quotation_money">
                </tr>
                <tr>
                    <th>認定額</th>
                    <td>{{ number_format($clients["certification_money"]) }}円</td>
                    <input type="hidden" value="{{ $clients['certification_money'] }}" name="certification_money">
                </tr>
                <tr>
                    <th>見積額の認定率（％）</th>
                    <td>{{ $certification_money_probability }}％</td>
                    <input type="hidden" value="{{ $certification_money_probability }}" name="certification_money_probability">
                </tr>
                <tr>
                    <th>請求手数料（％）</th>
                    <td>{{ $clients["client_fee"] }}％</td>
                    <input type="hidden" value="{{ $clients['client_fee'] }}" name="client_fee">
                </tr>
                <tr>
                    <th>入金額</th>
                    <td>{{ number_format($payment_money) }}円</td>
                    <input type="hidden" value="{{ $payment_money }}" name="payment_money">
                </tr>
                <tr>
                    <th>調査会社手数料（％）</th>
                    <td>{{ $clients["survey_referral"] }}％</td>
                    <input type="hidden" value="{{ $clients['survey_referral'] }}" name="survey_referral">
                </tr>
                <tr>
                    <th>調査会社支払額</th>
                    <td>{{ number_format($trader_payment_money) }}円</td>
                    <input type="hidden" value="{{ $trader_payment_money }}" name="trader_payment_money">
                </tr>
                <tr>
                    <th>取次店手数料（％）</th>
                    <td>{{ $clients["trader_referral"] }}％</td>
                    <input type="hidden" value="{{ $clients['trader_referral'] }}" name="trader_referral">
                </tr>
                <tr>
                    <th>取次店支払額</th>
                    <td>{{ number_format($survey_payment_money) }}円</td>
                    <input type="hidden" value="{{ $survey_payment_money }}" name="survey_payment_money">
                </tr>
                <tr>
                    <th>利益額</th>
                    <td>{{ number_format($profit_money) }}円</td>
                    <input type="hidden" value="{{ $profit_money }}" name="profit_money">
                </tr>

                <input type="hidden" class="form-control" value="{{'☆'}}" name="important">
                <input type="hidden" class="form-control" value="{{'△'}}" name="caution">
                <input type="hidden" name="user_id" value="{{ $user_id['id'] }}">
                <input type="hidden" class="form-control" value="{{'1'}}" name="client_drawing_id">
                <input type="hidden" class="form-control" value="{{'1'}}" name="client_agreement_id">
                <input type="hidden" class="form-control" value="{{'1'}}" name="client_insurance_policy_id">
                <input type="hidden" class="form-control" value="{{'1'}}" name="client_report_id">
                <input type="hidden" class="form-control" value="{{'1'}}" name="client_quotation_id">
                <input type="hidden" class="form-control" value="{{'1'}}" name="client_certification_id">
                <input type="hidden" class="form-control" value="{{'1'}}" name="client_bill_issue_id">

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
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-secondary" onclick="history.back()">入力フォームへ戻る</button>
            <input type="submit" value="登録" class="btn btn-info">
        </div>
    </form>
</div>
@endsection