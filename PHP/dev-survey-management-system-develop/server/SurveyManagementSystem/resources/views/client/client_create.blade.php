@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<script src="{{ asset('js/client_initial_value.js') }}"></script>

<div class="container">
    <div>
        <span style="font-size: 30px;">個人顧客情報登録</span>
    </div>

    {{-- 登録時DBエラーが発生した場合フラッシュメッセージを表示 --}}
    @if (session('error_message'))
    <div class="alert alert-danger">
        <ul>
            <!-- 更新失敗メッセージ -->
            <li>{{ session('error_message') }}</li>
        </ul>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="enter_check_top">
        <div id="enter_check"><font color="red">＊入力必須項目です</font></div>
        <div>
            <button onclick="location.href='{{ action('ClientController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
        </div>
    </div>

    <form action="{{ action('ClientController@create_check') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group border border-info">

            <div class="col-sm-9 content_position">
                <h4>＜案件情報＞</h4>
            </div>

            <div class="col-sm-4 content_position">
                <label>流入フラグ</label>
                <select name="advertising" class="form-control">
                    <option value='クオカード1000/3000' @if(old('advertising') == 'クオカード1000/3000') selected @endif>クオカード1000/3000</option>
                    <option value='クオカード2000/5000' @if(old('advertising') == 'クオカード2000/5000') selected @endif>クオカード2000/5000</option>
                    <option value='クオカード5000' @if(old('advertising') == 'クオカード5000') selected @endif>クオカード5000</option>
                    <option value='紹介キャンペーン' @if(old('advertising') == '紹介キャンペーン') selected @endif>紹介キャンペーン</option>
                    @foreach ($trader as $val)
                        <option value="{{ $val['id'] }}" @if(old('trader_name') == $val['trader_name']) selected @endif>{{ $val['id'] }}:{{ $val['trader_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>ID<font color="red">＊</font></label>
                <input type="text" class="form-control" name="member" value="{{ old('member') }}"  maxlength="10" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>氏名<font color="red">＊</font></label>
                <input type="text" class="form-control" name="contractor" value="{{ old('contractor') }}" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>住所<font color="red">＊</font></label>
                <input type="text" class="form-control" name="address" value="{{ old('address') }}" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>物件名</label>
                <input type="text" class="form-control" name="buildingname" value="{{ old('buildingname') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>連絡先<font color="red">＊</font></label>
                <input type="text" class="form-control" name="contractor_contact" value="{{ old('contractor_contact') }}" required placeholder="半角数字のみ入力して下さい。">
            </div>
            <div class="col-sm-4 content_position">
                <label>メールアドレス</label>
                <input type="text" class="form-control" name="mail_address" value="{{ old('mail_address') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>火災保険の加入状況</label>
                <select name="fire_insurance_flg" class="form-control" >
                    <option value='' selected>選択して下さい。</option>
                    <option value='1' @if(old('fire_insurance_flg') == '1') @endif>加入している</option>
                    <option value='0' @if(old('fire_insurance_flg') == '0') @endif>未加入</option>
                </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>保険会社</label>
                <input type="text" class="form-control" name="insurance_company" value="{{ old('insurance_company') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>築年数</label>
                <input type="text" class="form-control" name="building_age" value="{{ old('building_age') }}"  maxlength="10">
            </div>
            <div class="col-sm-4 content_position">
                <label>地震 有/無</label>
                <select name="earthquake_flg" class="form-control">
                    <option value=0 selected>無</option>
                    <option value=1 @if(old('earthquake_flg') == 1) selected @endif>有</option>
                </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>ステータス</label>
                <select name="status_name" class="form-control survey">
                    @foreach ($status as $value)
                        <option value="{{ $value['status_name'] }}" @if(old('status_name') == $value['status_name']) selected @endif>{{ $value['status_number'] }}:{{ $value['status_name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>アクション日付</label>
                <input type="date" class="form-control" name="action_date" value="{{ old('action_date') }}">
            </div>
            <div class="col-sm-12 content_position" style="margin-bottom:10px;">
                <label>アクション内容</label>
                <textarea class="form-control" name="action_note">{{ old('action_note') }}</textarea>
            </div>
            <div class="col-sm-12 content_position" style="margin-bottom:10px;">
                <label>備考</label>
                <textarea class="form-control" name="note">{{ old('note') }}</textarea>
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

            <div class="col-sm-9 content_position" style="margin-top: 15px;">
                <h4>＜保険申請進捗＞</h4>
            </div>

            <div class="col-sm-4 content_position">
                <label>営業担当</label>
                <input type="text" class="form-control" name="sales_staff" value="{{ old('sales_staff') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>調査会社</label>
                <select name="survey_name" class="form-control survey" id="survey">
                    <option value='' selected>選択してください</option>
                        @foreach ($surveie as $value)
                            <option value="{{ $value['survey_name'] }}" @if(old('survey_name') == $value['survey_name']) selected @endif>{{ $value['survey_name'] }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>現調担当</label>
                <input type="text" class="form-control" name="survey_staff" value="{{ old('survey_staff') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>依頼日</label>
                <input type="date" class="form-control" name="request_date" value="{{ old('request_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>現調予定日</label>
                <input type="date" class="form-control" name="scheduled_survey_date" value="{{ old('scheduled_survey_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>現調日</label>
                <input type="date" class="form-control" name="survey_date" value="{{ old('survey_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>合意書</label>
                <input type="date" class="form-control" name="agreement_date" value="{{ old('agreement_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>事故報告日</label>
                <input type="date" class="form-control" name="accident_date" value="{{ old('accident_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>保険申請日</label>
                <input type="date" class="form-control" name="insurance_policy_date" value="{{ old('insurance_policy_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>認定日</label>
                <input type="date" class="form-control" name="certification_date" value="{{ old('certification_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>請求日</label>
                <input type="date" class="form-control" name="bill_issue_date" value="{{ old('bill_issue_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>入金日</label>
                <input type="date" class="form-control" name="payment_date" value="{{ old('payment_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>クオカード送付日</label>
                <input type="text" class="form-control" name="quo_card_date" value="{{ old('quo_card_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>¥.見積額<font color="red">＊</font></label>
                <input type="text" class="form-control" name="quotation_money" value="{{ old('quotation_money') }}" id="quotation_money" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>¥.認定額<font color="red">＊</font></label>
                <input type="text" class="form-control" name="certification_money" value="{{ old('certification_money') }}" id="certification_money" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>請求手数料（％）<font color="red">＊</font></label>
                <input type="text" class="form-control" name="client_fee" value="{{ old('clients_fee') }}" id="clients_fee" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>調査会社手数料（％）<font color="red">＊</font></label>
                <input type="text" class="form-control" name="survey_referral" value="{{ old('survey_referral') }}" id="survey_referral" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>取次店手数料（％）<font color="red">＊</font></label>
                <input type="text" class="form-control" name="trader_referral" value="{{ old('trader_referral') }}" id="trader_referral" required>
            </div>
        </div>

        <div class="text-right">
            <input type="submit" value="登録確認" class="btn btn-info">
        </div>
    </form>
</div>
@endsection