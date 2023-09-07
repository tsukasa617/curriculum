@extends('layout/layout')
@section('title', '管理システム')

@section('content')
    <script src="{{ asset('js/matter_initial_value.js') }}"></script>

<div class="container">
    <div>
        <span style="font-size: 30px;">案件登録</span>
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
    <div class="alert alert-danger">
        <ul>
        <!-- 更新失敗メッセージ -->
            <div class="message">
                {{ session('message') }}
            </div>
        </ul>
    </div>
    @endif
    <div class="enter_check_top">
        <div id="enter_check"><font color="red" sizeof="16px">＊入力必須項目です。</font></div>
        <div>
            <button onclick="location.href='{{ action('MatterController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
        </div>
    </div>
    <form action="{{ action('MatterController@create_check') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group border border-info" style="padding-bottom:10px;">
            <div class="col-sm-9 content_position">
                <h4>＜案件情報＞</h4>
            </div>
            <div class="col-sm-4 content_position">
                <label>流入経路</label>
                    <select name="advertising_name" class="form-control">
                        @foreach ($advertisings as $val)
                            <option value="{{ $val['advertising_name'] }}" @if(old('advertisings') == $val['advertising_name']) selected @endif>{{ $val['advertising_name']}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>ID<font color="red">＊</font></label>
                <input type="text" class="form-control" value="{{ old('member') }}" name="member" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>グループ名</label>
                <input type="text" class="form-control" value="{{ old('group_name') }}" name="group_name">
            </div>
            <div class="col-sm-4 content_position">
                <label>会社名<font color="red">＊</font></label>
                <input type="text" class="form-control" value="{{ old('contractor') }}" name="contractor" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>契約者名</label>
                <input type="text" class="form-control" value="{{ old('insurance_policyholder') }}" name="insurance_policyholder">
            </div>
            <div class="col-sm-7 content_position">
                <label>住所<font color="red">＊</font></label>
                <input type="text" class="form-control" value="{{ old('address') }}" name="address" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>物件名</label>
                <input type="text" class="form-control" value="{{ old('buildingname') }}" name="buildingname">
            </div>
            <div class="col-sm-4 content_position">
                <label>建物種別</label>
                <input type="text" class="form-control" value="{{ old('property_information') }}" name="property_information">
            </div>
            <div class="col-sm-4 content_position">
                <label>連絡方法<font color="red">＊</font></label>
                <input type="text" class="form-control" value="{{ old('contact_method') }}" name="contact_method" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>台風名</label>
                <input type="text" class="form-control" value="{{ old('typhoon_name') }}" name="typhoon_name">
            </div>
            <div class="col-sm-4 content_position">
                <label>風速</label>
                <input type="text" class="form-control" value="{{ old('wind_speed') }}" name="wind_speed">
            </div>
            <div class="col-sm-2 content_position">
                <label>風災</label>
                <select name="wind_disaster" class="form-control">
                    <option value=0 selected>✖</option>
                    <option value=1 @if(old('wind_disaster') == 1) selected @endif>〇</option>
                </select>
            </div>
            <div class="col-sm-2 content_position">
                <label>震災</label>
                <select name="earthquake_disaster" class="form-control">
                    <option value=0 selected>✖</option>
                    <option value=1 @if(old('earthquake_disaster') == 1) selected @endif>〇</option>
                </select>
            </div>

            <div class="col-sm-4 content_position">
                <label>保険会社</label>
                <input type="text" class="form-control" value="{{ old('insurance_company') }}" name="insurance_company">
            </div>
            <div class="col-sm-4 content_position">
                <label>ステータス</label>
                    <select name="status_name" class="form-control">
                        @foreach ($matter_statuse as $val)
                            <option value="{{ $val['status_name'] }}" @if(old('status_name') == $val['status_name']) selected @endif>{{ $val['status_number']}}:{{ $val['status_name']}}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>アクション日付</label>
                <input type="date" class="form-control" value="{{ old('action_date') }}" name="action_date">
            </div>
            <div class="col-sm-12 content_position">
                <label>アクション内容</label>
                <textarea class="form-control" name="action_note">{{ old('action_note') }}</textarea>
            </div>
            <div class="col-sm-4 content_position">
                <label>入金予測時期</label>
                <input type="date" class="form-control" name="payment_predict_date" value="{{ old('payment_predict_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>入金期待値</label>
                <select name="payment_expecte" class="form-control">
                    <option value='0%' selected>0%</option>
                    <option value='25%' @if(old('payment_expecte') == '25%') selected @endif>25%</option>
                    <option value='50%' @if(old('payment_expecte') == '50%') selected @endif>50%</option>
                    <option value='75%' @if(old('payment_expecte') == '75%') selected @endif>75%</option>
                    <option value='100%' @if(old('payment_expecte') == '100%') selected @endif>100%</option>
                </select>
            </div>
            <div class="col-sm-12 content_position">
                <label>備考</label>
                <textarea class="form-control" name="note">{{ old('note') }}</textarea>
            </div>
            <div class="col-sm-3 content_position">
                <label>工事コンサル</label>
                    <select name="construction_consultant" class="form-control">
                        <option value=0 selected>コンサル</option>
                        <option value=1 @if(old('construction_consultant') == 1) selected @endif>工事</option>
                    </select>
            </div>
            <div class="col-sm-2 content_position">
                <label>図面</label>
                    <select name="drawing" class="form-control">
                        <option value=0 selected>-</option>
                        <option value=1 @if(old('drawing') == 1) selected @endif>〇</option>
                    </select>
            </div>
            <div class="col-sm-2 content_position">
                <label>保険証券</label>
                <select name="insurance_policy" class="form-control">
                    <option value=0 selected>-</option>
                    <option value=1 @if(old('insurance_policy') == 1) selected @endif>〇</option>
                </select>
            </div>
            <div class="col-sm-9 content_position" style="margin-top: 15px;">
                <h4>＜保険申請進捗＞</h4>
            </div>
            <div class="col-sm-4 content_position">
                <label>営業担当</label>
                <input type="text" class="form-control" name="sales_staff" value="{{ old('sales_staff') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>調査会社</label>
                <select name="survey_name" class="form-control">
                    <option value= '' selected>選択してください</option>
                    @foreach ($surveie as $val)
                        <option value="{{ $val['survey_name'] }}" @if(old('survey_name') == $val['survey_name']) selected @endif>{{ $val['survey_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>現調担当</label>
                <input type="text" class="form-control" value="{{ old('survey_staff') }}" name="survey_staff">
            </div>
            <div class="col-sm-4 content_position">
                <label>取次店<font color="red">＊</font></label>
                    <select name="trader_name" class="form-control" id = trader_name required>
                        <option value= '' selected>選択してください</option>
                        @foreach ($trader as $val)
                            <option value="{{ $val['id'] }}" @if(old('trader_name') == $val['trader_name']) selected @endif>{{ $val['id'] }}:{{ $val['trader_name'] }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>商談日</label>
                <input type="date" class="form-control" value="{{ old('scheduled_survey_date') }}" name="scheduled_survey_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>依頼日</label>
                <input type="date" class="form-control" value="{{ old('request_date') }}" name="request_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>現調日</label>
                <input type="date" class="form-control" value="{{ old('survey_date') }}" name="survey_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>合意書（例:10/01）</label>
                <input type="date" class="form-control" value="{{ old('agreement_date') }}" name="agreement_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>事故報告日</label>
                <input type="date" class="form-control" value="{{ old('accident_date') }}" name="accident_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>保険申請日</label>
                <input type="date" class="form-control" value="{{ old('insurance_policy_date') }}" name="insurance_policy_date">
            </div>

            <div class="col-sm-4 content_position">
                <label>認定日</label>
                <input type="date" class="form-control" value="{{ old('certification_date') }}" name="certification_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>請求用紙到着（民間）</label>
                <input type="date" class="form-control" value="{{ old('billing_receipt_date') }}" name="billing_receipt_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>請求日</label>
                <input type="date" class="form-control" value="{{ old('bill_issue_date') }}" name="bill_issue_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>入金日</label>
                <input type="date" class="form-control" value="{{ old('payment_date') }}" name="payment_date">
            </div>

            <div class="col-sm-4 content_position">
                <label>報告書完成日</label>
                <input type="date" class="form-control" value="{{ old('report_completed_date') }}" name="report_completed_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>見積書完成日</label>
                <input type="date" class="form-control" value="{{ old('quotation_completed_date') }}" name="quotation_completed_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>鑑定日</label>
                <input type="date" class="form-control" value="{{ old('judge_date') }}" name="judge_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>発送日</label>
                <input type="date" class="form-control" value="{{ old('submit_sending_date') }}" name="submit_sending_date">
            </div>
            <div class="col-sm-4 content_position">
                <label>発送先<br>(保険会社/お客様)</label>
                <input type="text" class="form-control" value="{{ old('document_submit_to') }}" name="document_submit_to">
            </div>
            <div class="col-sm-4 content_position">
                <label>顧客請求書送付</label>
                <input type="date" class="form-control" value="{{ old('customer_invoice_date') }}" name="customer_invoice_date">
            </div>

            <div class="col-sm-4 content_position">
                <label>¥.見積額<font color="red">＊</font></label>
                <input type="number" class="form-control" value="{{ old('quotation_money') }}" name="quotation_money" id="quotation_money" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>¥.認定額<font color="red">＊</font></label>
                <input type="number" class="form-control" value="{{ old('certification_money') }}" name="certification_money" id="certification_money" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>請求手数料(%)<font color="red">＊</font></label>
                <input type="number" class="form-control" value="{{ old('fee') }}"name="fee" id="fee" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>調査会社手数料(%)<font color="red">＊</font></label>
                <input type="number" class="form-control" value="{{ old('survey_referral') }}" name="survey_referral" id="survey_referral" required>
            </div>

            <div class="col-sm-4 content_position">
                <label>取次店１：紹介率(%)<font color="red">＊</font></label>
                <input type="number" class="form-control" value="{{ old('referral_rate') }}" name="referral_rate"  id="referral_rate" required>
            </div>

            <div class="col-sm-4 content_position">
                <label>取次店２：紹介率(%)<font color="red">＊</font></label>
                <input type="number" class="form-control" value="{{ old('referral_rate_2') }}" name="referral_rate_2" id="referral_rate_2" required>
            </div>

            <div class="col-sm-4 content_position">
                <label>取次店３：紹介率(%)<font color="red">＊</font></label>
                <input type="number" class="form-control" value="{{ old('referral_rate_3') }}" name="referral_rate_3" id="referral_rate_3" required>
            </div>
        </div>
        
        <div class="text-right">
            <input type="submit" value="登録確認" class="btn btn-info">
        </div>
    </form>
</div>
@endsection