@extends('layout/layout')
@section('title', '管理システム')

@section('content')
<script src="{{ asset('js/client_search.js') }}"></script>
<div>
    <span style="font-size: 30px; margin-left: 60px;">案件登録</span>
</div>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ action('MatterController@create_check') }}" method="POST">
        {{ csrf_field() }}

        <div class="form-group row border border-info matter_frame">

            <div class="col-sm-4 content_position">
                <label>会員番号(案件番号)</label>
                <input type="text" class="form-control" name="member_id" id="member_id" value="{{ $info->member_id }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>業者<font color="red">*</font></label>
                <select name="trader" class="form-control trader" id="trader">
                    <option value="">業者を選択してください</option>
                    @foreach ($trader as $val)
                    @if ( $val->id == $info->trader )
                    <option value="{{ $val->id }}" selected>{{ $val->trader_name }}</option>
                    @continue
                    @endif

                    <option value="{{ $val->id }}">{{ $val->trader_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4 content_position">
                <label>担当者<font color="red">*</font></label>
                <select name="survey" class="form-control survey" id="survey">
                    <option value="" class="msg">選択してください</option>
                    @foreach ($survey_a as $key => $value)
                    @if ( $key == $info->survey )
                    <option data-val="1" value="{{ $key }}" selected>{{ $value }}</option>
                    @continue
                    @endif
                    <option data-val="1" value="{{ $key }}">{{ $value }}</option>
                    @endforeach

                    @foreach ($survey_b as $key => $value)
                    @if ( $key == $info->survey )
                    <option data-val="2" value="{{ $key }}" selected>{{ $value }}</option>
                    @continue
                    @endif
                    <option data-val="2" value="{{ $key }}">{{ $value }}</option>
                    @endforeach

                    @foreach ($survey_c as $key => $value)
                    @if ( $key == $info->survey )
                    <option data-val="3" value="{{ $key }}" selected>{{ $value }}</option>
                    @continue
                    @endif
                    <option data-val="3" value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-4 content_position">
                <label>受付完了日</label>
                <input type="date" class="form-control" name="completion_date" value="{{ old('completion_date') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>契約日</label>
                <input type="date" class="form-control" name="contract_date" value="{{ old('contract_date') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>契約者</label>
                <input type="text" class="form-control" name="contractor" value="{{ $info->contractor }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>契約者連絡先</label>
                <input type="text" class="form-control" name="contractor_contact" id="contractor_contact" value="{{ $info->contractor_contact }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>対応者</label>
                <input type="text" class="form-control" name="responder" value="{{ old('responder') }}">
            </div>

            <div class="col-sm-2 content_position">
                <label>契約項目<font color="red">*</font></label>
                <select name="contract_item" class="form-control" required>
                    <option value="" selected>--</option>
                    <option value="火災" @if(old('contract_item')=='火災' ) selected @endif>火災</option>
                    <option value="地震" @if(old('contract_item')=='地震' ) selected @endif>地震</option>
                </select>
            </div>

            <div class="col-sm-4 content_position">
                <label>契約書</label>
                <input type="text" class="form-control" name="contract" value="{{ old('contract') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>業務報酬</label>
                <input type="text" class="form-control" name="work_reward" value="{{ old('work_reward') }}">
            </div>

            <div class="col-sm-2 content_position">
                <label>保険金入金先</label>
                <select name="insurance_account_payable" class="form-control">
                    <option value="" selected></option>
                    <option value="当協会" @if(old('insurance_account_payable')=='当協会' ) selected @endif>当協会</option>
                    <option value="お客様" @if(old('insurance_account_payable')=='お客様' ) selected @endif>お客様</option>
                </select>
            </div>

            <div class="col-sm-6">
                <label>郵便番号<font color="red">*</font> <small>
                        <font color="red">※契約者住所と物件住所が違う場合は変更してください。</font>
                    </small></label>
                <input type="text" class="form-control col-sm-6" name="zipcode" id="zipcode" value="{{ $info->zipcode }}" maxlength="7" required>
            </div>

            <div class="col-sm-4 content_position">
                <label>都道府県<font color="red">*</font></label>
                <input type="text" class="form-control" name="prefectures" id="prefectures" value="{{ $info->prefectures }}" required>
            </div>

            <div class="col-sm-4 content_position">
                <label>市区町村<font color="red">*</font></label>
                <input type="text" class="form-control" name="city" id="city" value="{{ $info->city }}" required>
            </div>

            <div class="col-sm-4 content_position">
                <label>町域<font color="red">*</font></label>
                <input type="text" class="form-control" name="town_area" id="town_area" value="{{ $info->town_area }}" required>
            </div>

            <div class="col-sm-4 content_position">
                <label>建物名・部屋番号</label>
                <input type="text" class="form-control" name="buildingname_roomnumber" id="buildingname_roomnumber" value="{{ $info->buildingname_roomnumber }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>建築年月日</label>
                <input type="date" class="form-control" name="building_date" value="{{ old('building_date') }}">
            </div>

            <div class="col-sm-2 content_position">
                <label>図面</label>
                <select name="drawing" class="form-control">
                    <option value="" selected>--</option>
                    <option value="有" @if(old('drawing')=='有' ) selected @endif>有</option>
                    <option value="無" @if(old('drawing')=='無' ) selected @endif>無</option>
                </select>
            </div>

            <div class="col-sm-2 content_position">
                <label>図面共有</label>
                <select name="drawing_share" class="form-control">
                    <option value="" selected>--</option>
                    <option value="図面共有済み" @if(old('drawing_share')=='図面共有済み' ) selected @endif>図面共有済み</option>
                    <option value="図面画像なし" @if(old('drawing_share')=='図面画像なし' ) selected @endif>図面画像なし</option>
                </select>
            </div>

            <div class="col-sm-2 content_position">
                <label>平日調査可否</label>
                <select name="weekday_survey" class="form-control">
                    <option value="" selected>--</option>
                    <option value="可" @if(old('weekday_survey')=='可' ) selected @endif>可</option>
                    <option value="不可" @if(old('weekday_survey')=='不可' ) selected @endif>不可</option>
                    <option value="不明" @if(old('weekday_survey')=='不明' ) selected @endif>不明</option>
                </select>
            </div>

            <div class="col-sm-2 content_position">
                <label>構造</label>
                <select name="structure" class="form-control">
                    <option value="" selected>--</option>
                    <option value="在来軸組" @if(old('structure')=='在来軸組' ) selected @endif>在来軸組</option>
                    <option value="枠組壁" @if(old('structure')=='枠組壁' ) selected @endif>枠組壁</option>
                    <option value="鉄骨" @if(old('structure')=='鉄骨' ) selected @endif>鉄骨</option>
                    <option value="RC" @if(old('structure')=='RC' ) selected @endif>RC</option>
                    <option value="SRC" @if(old('structure')=='SRC' ) selected @endif>SRC</option>
                    <option value="WRC" @if(old('structure')=='WRC' ) selected @endif>WRC</option>
                    <option value="鉄筋" @if(old('structure')=='鉄筋' ) selected @endif>鉄筋</option>
                    <option value="混構造" @if(old('structure')=='混構造' ) selected @endif>混構造</option>
                    <option value="その他" @if(old('structure')=='その他' ) selected @endif>その他</option>
                </select>
            </div>

            <div class="col-sm-2 content_position">
                <label>修繕歴</label>
                <select name="repair_history" class="form-control">
                    <option value="" selected>--</option>
                    <option value="有" @if(old('repair_history')=='有' ) selected @endif>有</option>
                    <option value="無" @if(old('repair_history')=='無' ) selected @endif>無</option>
                </select>
            </div>

            <div class="col-sm-4 content_position">
                <label>修繕日</label>
                <input type="date" class="form-control" name="repair_date" value="{{ old('repair_date') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>修繕内容</label>
                <input type="text" class="form-control" name="repair_content" value="{{ old('repair_content') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>保険会社</label>
                <input type="text" class="form-control" name="insurance_company" value="{{ old('insurance_company') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>保険金額</label>
                <input type="text" class="form-control" name="insurance_amount" value="{{ old('insurance_amount') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>保険加入日</label>
                <input type="date" class="form-control" name="insurance_joindate" value="{{ old('insurance_joindate') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>保険証券番号</label>
                <input type="text" class="form-control" name="insurance_policynumber" value="{{ old('insurance_policynumber') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>保険申請歴</label>
                <select name="insurance_applicationdate" class="form-control">
                    <option value="" selected>--</option>
                    <option value="有" @if(old('insurance_applicationdate')=='有' ) selected @endif>有</option>
                    <option value="無" @if(old('insurance_applicationdate')=='無' ) selected @endif>無</option>
                </select>
            </div>

            <div class="col-sm-4 content_position">
                <label>申請日</label>
                <input type="date" class="form-control" name="application_date" value="{{ old('application_date') }}">
            </div>

            <div class="col-sm-4 content_position">
                <label>申請内容</label>
                <input type="text" class="form-control" name="application_content" value="{{ old('application_content') }}">
            </div>

            <div class="col-sm-12 content_position">
                <label>備考</label>
                <textarea class="form-control" name="note">{{ old('note') }}</textarea>
            </div>

            <div class="col-sm-12 content_position">
                <label>社内用備考</label>
                <textarea class="form-control" name="within_company_note">{{ old('within_company_note') }}</textarea>
            </div>

            <div class="col-sm-2 content_position">
                <label>工事</label>
                <select name="construction" class="form-control">
                    <option value="無" selected @if(old('construction')=='無' ) selected @endif>無</option>
                    <option value="" @if(old('construction')=='' ) selected @endif>--</option>
                    <option value="有" @if(old('construction')=='有' ) selected @endif>有</option>
                    <option value="検討" @if(old('construction')=='検討' ) selected @endif>検討</option>
                </select>
            </div>

            <div class="col-sm-2 content_position">
                <label>管轄</label>
                <select name="jurisdiction" class="form-control">
                    <option value="無" selected @if(old('repair_history')=='無' ) selected @endif>無</option>
                    <option value="" @if(old('construction')=='' ) selected @endif>--</option>
                    <option value="自社" @if(old('repair_history')=='自社' ) selected @endif>自社</option>
                    <option value="他社" @if(old('repair_history')=='他社' ) selected @endif>他社</option>
                    <option value="検討" @if(old('repair_history')=='検討' ) selected @endif>検討</option>
                </select>
            </div>
        </div>

        <div class="text-right">
            <!--<button onclick="location.href=''" class="btn btn-info">メニューに戻る</button>-->
            <input type="submit" value="登録確認" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection
