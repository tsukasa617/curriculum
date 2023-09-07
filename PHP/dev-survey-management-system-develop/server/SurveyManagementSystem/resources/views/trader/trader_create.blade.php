@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">取次店登録</span>
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
    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('success_message') }}</li>
        </ul>
    </div>
    @endif

    <div class="enter_check_top">
        <div id="enter_check"><font color="red">＊入力必須項目です</font></div>
        <div>
            <button onclick="location.href='{{ action('TraderController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
        </div>
    </div>

    <form action="{{ action('TraderController@create_check') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group border border-info">

            <div class="col-sm-4 content_position">
                <label>紹介者<font color="red">＊</font></label>
                <select name="introducer" class="form-control">
                    <option value="0">紹介者無し</option>
                    @foreach ($traders as $val)
                        <option value="{{ $val['id'] }}" @if(old('introducer') == $val['trader_name']) selected @endif>{{ $val['id']}}:{{ $val['trader_name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3 content_position">
                <label>VIP</label>
                <select name="vip" class="form-control">
                    <option value=0 selected>-</option>
                    <option value=1 @if(old('vip') == 1) selected @endif>〇</option>
                </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>取次店<font color="red">＊</font></label>
                <input type="text" class="form-control" name="trader_name" value="{{ old('trader_name') }}" required>
            </div>
            <div class="col-sm-3 content_position">
                <label>法人・個人</label>
                <select name="business_form" class="form-control">
                    <option value=0 selected>法人</option>
                    <option value=1 @if(old('business_form') == 1) selected @endif>個人</option>
                </select>
            </div>
            <div class="col-sm-6 content_position">
                <label>メールアドレス<font color="red">＊</font></label>
                <input type="email" class="form-control" name="trader_email"  maxlength="100" value="{{ old('trader_email') }}" required>
            </div>
            <div class="col-sm-6 content_position">
                <label>所属企業<font color="red">＊</font></label>
                <input type="text" class="form-control" name="affiliated_company" value="{{ old('affiliated_company') }}" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>役職</label>
                <input type="text" class="form-control" name="position" value="{{ old('position') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>郵便番号<font color="red">＊</font></label>
                <input type="text" class="form-control" name="trader_zipcode" value="{{ old('trader_zipcode') }}" maxlength="7" placeholder="半角数字のみ入力して下さい" required>
            </div>
            <div class="col-sm-7 content_position">
                <label>住所<font color="red">＊</font></label>
                <input type="text" class="form-control" name="trader_address" value="{{ old('trader_address') }}" placeholder="番地・建物名まで入力して下さい"  required>
            </div>
            <div class="col-sm-4 content_position">
                <label>電話番号<font color="red">＊</font></label>
                <input type="text" class="form-control" name="trader_phone" value="{{ old('trader_phone') }}" maxlength="13" placeholder="半角数字のみ入力して下さい" required>
            </div>
            <div class="col-sm-4 content_position">
                <label>電話番号2</label>
                <input type="text" class="form-control" name="trader_phone_2" value="{{ old('trader_phone_2') }}" maxlength="13" placeholder="半角数字のみ入力して下さい">
            </div>
            <div class="col-sm-4 content_position">
                <label>金融機関</label>
                <input type="text" class="form-control" name="financial_institution" value="{{ old('financial_institution') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>支店名</label>
                <input type="text" class="form-control" name="financial_branch" value="{{ old('financial_branch') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>口座種類</label>
                <select name="bank_acount_kinds" class="form-control">
                    <option value=0 selected>普通</option>
                    <option value=1 @if(old('bank_acount_kinds') == 1) selected @endif>当座</option>
                </select>
            </div>
            <div class="col-sm-4 content_position">
                <label>口座番号</label>
                <input type="text" class="form-control" name="bank_acount_number" value="{{ old('bank_acount_number') }}" maxlength="18" placeholder="半角数字のみ入力して下さい">
            </div>
            <div class="col-sm-4 content_position">
                <label>口座名義</label>
                <input type="text" class="form-control" name="bank_acount_name" value="{{ old('bank_acount_name') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>契約書送付日</label>
                <input type="date" class="form-control" name="contract_sending_date" value="{{ old('contract_sending_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>契約書締結日</label>
                <input type="date" class="form-control" name="contract_conclusion_date" value="{{ old('contract_conclusion_date') }}">
            </div>
            <div class="col-sm-4 content_position">
                <label>秘密保持契約書データ送付日</label>
                <input type="date" class="form-control" name="secret_contract_date" value="{{ old('secret_contract_date') }}">
            </div>
            <div class="col-sm-6 content_position">
                <label>主な案件</label>
                <input type="text" class="form-control" name="main_project" value="{{ old('main_project') }}">
            </div>
            <div class="col-sm-12 content_position">
                <label>備考</label>
                <textarea class="form-control" name="trader_note">{{ old('trader_note') }}</textarea>
            </div>
        </div>

        <div class="text-right">
            <input type="submit" value="登録確認" class="btn btn-info">
        </div>

    </form>
</div>
@endsection