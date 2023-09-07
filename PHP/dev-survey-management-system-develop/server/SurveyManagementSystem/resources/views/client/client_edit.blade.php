@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">
    <script src="{{ asset('js/client_search.js') }}"></script>

<div class="container">

    <div>
        <span style="font-size: 30px;">顧客情報修正</span>
    </div>

    @if (session('error_message'))
    <div class="alert alert-danger">
        <ul>
            <!-- 更新失敗メッセージ -->
            <li>
                {{ session('error_message') }}
            </li>
        </ul>
    </div>
    @endif
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div id="detail_menu">
        @php $authoritys = session()->get('authoritys'); @endphp
        <form action="{{ action('ClientController@edit_check') }}" method="POST" enctype="multipart/form-data" style="z-index: 1;">
            {{ csrf_field() }}
            <div class="enter_check_top">
                <div id="enter_check"><font color="red">＊入力必須項目です</font></div>
                <div>
                    <ul class="any_method" style="float: right;padding-bottom: 15px;">
                        @foreach($authoritys as $authorities)
                            @if($authorities == "削除")
                                <li>
                                    <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal1">削除</button>
                                </li>
                            @endif
                        @endforeach
                            <!-- ↓モーダル表示部分↓ -->
                            <li><div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="label1">確認</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            本当に削除しますか？
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                            <a href="{{ action('ClientController@delete',['id' => $clients['id']]) }}">
                                                <button type="button" class="btn btn-danger">OK</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div></li>
                        <li><button type="button" onclick="location.href='{{ action('ClientController@all') }}'" class="btn btn-secondary">一覧に戻る</button></li>
                    </ul>
                </div>
            </div>

            @php $authoritys = session()->get('authoritys'); @endphp
                <table class="table table-bordered">
                    <input type="hidden" name="id" value="{{ $clients['id'] }}">

                    <tr>
                        <td colspan="2"><h4>＜案件情報＞</h4></td>
                    </tr>

                    <tr>
                        <th>流入経路</th>
                        <td>
                            <select name="advertising" class="form-control">
                                <option value="{{ $clients['advertising'] }}" selected>{{ $clients['advertising'] }}</option>
                                <option value='クオカード1000/3000'>クオカード1000/3000</option>
                                <option value='クオカード2000/5000'>クオカード2000/5000</option>
                                <option value='クオカード5000'>クオカード5000</option>
                                <option value='取次店'>取次店</option>
                                <option value='紹介キャンペーン'>紹介キャンペーン</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>ID<font color="red">＊</font></th>
                        <td><input type="text" class="form-control" name="member" value="{{ $clients['member'] }}" maxlength="10" required></td>
                    </tr>
                    <tr>
                        <th>氏名<font color="red">＊</font></th>
                        <td><input type="text" class="form-control" name="contractor" value="{{ $clients['contractor'] }}" required></td>
                    </tr>
                    <tr>
                        <th>住所<font color="red">＊</font></th>
                        <td><input type="text" class="form-control" name="address" value="{{ $clients['address'] }}" required></td>
                    </tr>
                    <tr>
                        <th>物件名</th>
                        <td><input type="text" class="form-control" name="buildingname" value="{{ $clients['buildingname'] }}"></td>
                    </tr>
                    <tr>
                        <th>連絡先<font color="red">＊</font></th>
                        <td><input type="text" class="form-control" name="contractor_contact" value="{{ $clients['contractor_contact'] }}" required></td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td><input type="text" class="form-control" name="mail_address" value="{{ $clients['mail_address'] }}"></td>
                    </tr>
                    <tr>
                        <th>火災保険の加入状況</th>
                        <td>
                            <select name="fire_insurance_flg" class="form-control">
                                <option value="{{ $clients['fire_insurance_flg'] }}" selected>
                                    @if($clients["fire_insurance_flg"] == '0')
                                    @php print '未加入'; @endphp
                                @elseif($clients["fire_insurance_flg"] == '1')
                                    @php print '加入している'; @endphp
                                @else
                                    @php print ''; @endphp
                                @endif
                                </option>
                                <option value= 0>未加入</option>
                                <option value= 1>加入している</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>保険会社</th>
                        <td><input type="text" class="form-control" name="insurance_company" value="{{ $clients['insurance_company'] }}"></td>
                    </tr>
                    <tr>
                        <th>築年数</th>
                        <td><input type="text" class="form-control" name="building_age" value="{{ $clients['building_age'] }}"></td>
                    </tr>
                    @foreach($authoritys as $authorities)
                        @if($authorities == "裏カラム")
                            <tr>
                                <th>地震 有/無</th>
                                <td>
                                    <select name="earthquake_flg" class="form-control">
                                        <option value="{{ $clients['earthquake_flg'] }}" selected>
                                            @if($clients['earthquake_flg'] == 0) 
                                                @php print '無'; @endphp
                                            @else
                                                @php print '有'; @endphp
                                            @endif
                                        </option>
                                        <option value= 0>無</option>
                                        <option value= 1>有</option>
                                    </select>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <th>ステータス</th>
                        <td>
                            <select name="status_name" class="form-control">
                                <option value="{{ $clients->status_name }}" selected>{{ $clients->status_number }}:{{ $clients->status_name }}</option>
                                @foreach ($status_name as $val)
                                    <option value="{{ $val['status_name'] }}">{{ $val['status_number'] }}:{{ $val['status_name'] }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>アクション日付</th>
                        <td><input type="date" class="form-control" name="action_date" value="{{ $clients['action_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>アクション内容</th>
                        <td><textarea class="form-control" name="action_note" value="{{ $clients['action_note'] }}"></textarea></td>
                    </tr>
                    <tr class="col-sm-12 content_position" style="margin-bottom:10px;">
                        <th>備考</th>
                        <td><textarea class="form-control" name="note" value="{{ $clients['note'] }}"></textarea></td>
                    </tr>
                    <tr>
                        <th>入金予測時期</th>
                        <td><input type="date" class="form-control" name="payment_predict_date" value="{{ $clients['payment_predict_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>入金期待値</th>
                        <td>
                            <select name="payment_expecte" class="form-control">
                                <option value="{{ $clients['payment_expecte'] }}" selected>{{ $clients['payment_expecte'] }}</option>
                                <option value='25%'>25%</option>
                                <option value='50%'>50%</option>
                                <option value='75%'>75%</option>
                                <option value='100%'>100%</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2"><h4>＜保険申請進捗＞</h4></td>
                    </tr>

                    <tr>
                        <th>営業担当</th>
                        <td><input type="text" class="form-control" name="sales_staff" value="{{ $clients['sales_staff'] }}"></td>
                    </tr>
                    <tr>
                        <th>調査会社</th>
                        <td>
                            <select name="survey_name" class="form-control">
                                <option value="{{ $clients->survey_name }}" selected>{{ $clients->survey_name }}</option>
                                @foreach ($survey_corps as $val)
                                    <option value="{{ $val['survey_name'] }}">{{ $val['survey_name'] }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>現調担当</th>
                        <td><input type="text" class="form-control" name="survey_staff" value="{{ $clients['survey_staff'] }}"></td>
                    </tr>
                    <tr>
                        <th>依頼日</th>
                        <td><input type="date" class="form-control" name="request_date" value="{{ $clients['request_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>現調予定日</th>
                        <td><input type="date" class="form-control" name="scheduled_survey_date" value="{{ $clients['scheduled_survey_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>現調日</th>
                        <td><input type="date" class="form-control" name="survey_date" value="{{ $clients['survey_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>合意書</th>
                        <td><input type="date" class="form-control" name="agreement_date" value="{{ $clients['agreement_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>事故報告日</th>
                        <td><input type="date" class="form-control" name="accident_date" value="{{ $clients['accident_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>保険申請日</th>
                        <td><input type="date" class="form-control" name="insurance_policy_date" value="{{ $clients['insurance_policy_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>認定日</th>
                        <td><input type="date" class="form-control" name="certification_date" value="{{ $clients['certification_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>請求日</th>
                        <td><input type="date" class="form-control" name="bill_issue_date" value="{{ $clients['bill_issue_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>入金日</th>
                        <td><input type="date" class="form-control" name="payment_date" value="{{ $clients['payment_date'] }}"></td>
                    </tr>
                    <tr>
                        <th>クオカード送付日</th>
                        <td><input type="date" class="form-control" name="quo_card_date" value="{{ $clients['quo_card_date'] }}"></td>
                    </tr>

                    <tr>
                        <th>¥.見積額<font color="red">＊</font></th>
                        <td><label for="quotation_money" style="float:left; margin-right:5px;">¥</label><input type="number" class="form-control"   name="quotation_money" value="{{ $clients['quotation_money'] }}" style="width:50%;" id="quotation_money" required></td>
                    </tr>
                    <tr>
                        <th>¥.認定額<font color="red">＊</font></th>
                        <td><label for="certification_money" style="float:left; margin-right:5px;">¥</label><input type="number" class="form-control"   name="certification_money" value="{{ $clients['certification_money'] }}" style="width:50%;" id="certification_money" required></td>
                    </tr>
                    <tr>
                        <th>請求手数料（％）<font color="red">＊</font></th>
                        <td><label for="client_fee" style="margin-right: 65%;">%</label><input type="text" class="form-control" name="client_fee" value="{{ $clients['client_fee'] }}" style="width:25%;" id="client_fee" required></td>
                    </tr>
                    <tr>
                        <th>調査会社手数料（％）<font color="red">＊</font></th>
                        <td><label for="survey_referral" style="margin-right: 65%;">%</label><input type="text" class="form-control" name="survey_referral" value=" {{ $clients['survey_referral'] }}" style="width:25%;" id="survey_referral" required></td>
                    </tr>
                    <tr>
                        <th>取次店手数料（％）<font color="red">＊</font></th>
                        <td><label for="trader_referral" style="margin-right: 65%;">%</label><input type="text" class="form-control" name="trader_referral" value="{{ $clients['trader_referral'] }}" style="width:25%;" id="trader_referral" required></td>
                    </tr>

                    <tr>
                        <td colspan="2"><h4>＜証券データ＞</h4></td>
                    </tr>

                    <tr>
                        <th>保険証券データ</th>
                        <td><button type="button" class="btn btn-outline-dark space_botton"  data-toggle="modal" data-target="#insurance_policy_modal" style="background-color:silver #c0c0c0;">保険証券データ</button></td>
                    </tr>
                    <input type="hidden" class="form-control" name="client_insurance_policy_id" value="{{ $clients['client_insurance_policy_id'] }}">
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="insurance_policy_modal" tabindex="-1" role="dialog" aria-labelledby="insurance_policy" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="insurance_policy">保険証券データの変更</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>タイトル</label>
                                            <input type="text" class="form-control" name="insurance_policy_title" value="{{ $clients['insurance_policies_image_title']}}">
                                        </div>
                                        <div class="form-group">
                                            <label>データのインポート</label><br>
                                            <b><font color="red">ファイル形式:jpeg,png,jpg,bmbのみ ファイルサイズ:2MBまで</font></b>
                                            <input type="file" class="form-control-file" name="insurance_policy_import" id="insurance_policy_preview">
                                        </div>
                                        <img id="insurance_policy_img_preview" style="max-width: 450px; max-height: 450px;">
                                        <script>
                                            $('#insurance_policy_preview').on('change', function (e) {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    $("#insurance_policy_img_preview").attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(e.target.files[0]);
                                            });
                                        </script>
                                        <div class="form-group">
                                            <label>現在のデータ</label>
                                            <img src="{{ url($clients['insurance_policies_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                            <input type="hidden" class="form-control" value="{{ $clients['insurance_policies_image_path'] }}" name="before_insurance_policy">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">変更画面へ</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <tr>
                        <th>合意書データ</th>
                        <td><button type="button" class="btn btn-outline-dark space_botton"  data-toggle="modal" data-target="#agreement_modal" style="background-color:silver #c0c0c0;">合意書データ</button></td>
                    </tr>
                    <input type="hidden" class="form-control" name="client_agreement_id" value="{{ $clients['client_agreement_id'] }}">
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="agreement_modal" tabindex="-1" role="dialog" aria-labelledby="agreement" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="agreement">合意書データの変更</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>タイトル</label>
                                            <input type="text" class="form-control" name="agreement_title" value="{{ $clients['agreements_image_title'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>データのインポート</label><br>
                                            <b><font color="red">ファイル形式:jpeg,png,jpg,bmbのみ ファイルサイズ:2MBまで</font></b>
                                            <input type="file" class="form-control-file" name="agreement_import" id="agreement_preview">
                                        </div>
                                        <img id="agreement_img_preview" style="max-width: 450px; max-height: 450px;">
                                        <script>
                                            $('#agreement_preview').on('change', function (e) {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    $("#agreement_img_preview").attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(e.target.files[0]);
                                            });
                                        </script>
                                        <div class="form-group">
                                            <label>現在のデータ</label>
                                            <img src="{{ url($clients['agreements_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                            <input type="hidden" class="form-control" value="{{ $clients['agreements_image_path'] }}" name="before_agreement">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">変更画面へ</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <tr>
                        <th>報告書データ</th>
                        <td><button type="button" class="btn btn-outline-dark space_botton" data-toggle="modal" data-target="#report_modal" style="background-color:silver #c0c0c0;">報告書データ</button></td>
                    </tr>
                    <input type="hidden" class="form-control" name="client_report_id" value="{{ $clients['client_report_id'] }}">
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="report_modal" tabindex="-1" role="dialog" aria-labelledby="report" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="report">報告書データの変更</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>タイトル</label>
                                            <input type="text" class="form-control" name="report_title" value="{{ $clients['reports_image_title'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>データのインポート</label><br>
                                            <b><font color="red">ファイル形式:jpeg,png,jpg,bmbのみ ファイルサイズ:2MBまで</font></b>
                                            <input type="file" class="form-control-file" name="report_import" id="report_preview">
                                        </div>
                                        <img id="report_img_preview" style="max-width: 450px; max-height: 450px;">
                                        <script>
                                            $('#report_preview').on('change', function (e) {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    $("#report_img_preview").attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(e.target.files[0]);
                                            });
                                        </script>
                                        <div class="form-group">
                                            <label>現在のデータ</label>
                                            <img src="{{ url($clients['reports_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                            <input type="hidden" class="form-control" value="{{ $clients['reports_image_path'] }}" name="before_report">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">変更画面へ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                    <tr>
                        <th>見積書データ</th>
                        <td><button type="button" class="btn btn-outline-dark space_botton"  data-toggle="modal" data-target="#quotation_modal" style="background-color:silver #c0c0c0;">見積書データ</button></td>
                    </tr>
                    <input type="hidden" class="form-control" name="client_quotation_id" value="{{ $clients['client_quotation_id'] }}">
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="quotation_modal" tabindex="-1" role="dialog" aria-labelledby="quotation" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="quotation">見積書データの変更</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>タイトル</label>
                                            <input type="text" class="form-control" name="quotation_title" value="{{ $clients['quotations_image_title'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>データのインポート</label><br>
                                            <b><font color="red">ファイル形式:jpeg,png,jpg,bmbのみ ファイルサイズ:2MBまで</font></b>
                                            <input type="file" class="form-control-file" name="quotation_import" id="quotation_preview">
                                        </div>
                                        <img id="quotation_img_preview" style="max-width: 450px; max-height: 450px;">
                                        <script>
                                            $('#quotation_preview').on('change', function (e) {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    $("#quotation_img_preview").attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(e.target.files[0]);
                                            });
                                        </script>
                                        <div class="form-group">
                                            <label>現在のデータ</label>
                                            <img src="{{ url($clients['quotations_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                            <input type="hidden" class="form-control" value="{{ $clients['quotations_image_path'] }}" name="before_quotation">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">変更画面へ</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <tr>
                        <th>認定書データ</th>
                        <td><button type="button" class="btn btn-outline-dark space_botton"  data-toggle="modal" data-target="#certification_modal" style="background-color:silver #c0c0c0; ">認定書データ</button></td>
                    </tr>
                    <input type="hidden" class="form-control" name="client_certification_id" value="{{ $clients['client_certification_id'] }}">
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="certification_modal" tabindex="-1" role="dialog" aria-labelledby="certification" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="certification">認定書データの変更</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>タイトル</label>
                                            <input type="text" class="form-control" name="certification_title" value="{{ $clients['certifications_image_title'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>データのインポート</label><br>
                                            <b><font color="red">ファイル形式:jpeg,png,jpg,bmbのみ ファイルサイズ:2MBまで</font></b>
                                            <input type="file" class="form-control-file" name="certification_import" id="certification_preview">
                                        </div>
                                        <img id="certification_img_preview" style="max-width: 450px; max-height: 450px;">
                                        <script>
                                            $('#certification_preview').on('change', function (e) {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    $("#certification_img_preview").attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(e.target.files[0]);
                                            });
                                        </script>
                                        <div class="form-group">
                                            <label>現在のデータ</label>
                                            <img src="{{ url($clients['certifications_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                            <input type="hidden" class="form-control" value="{{ $clients['certifications_image_path'] }}" name="before_certification">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">変更画面へ</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <tr>
                        <th>その他データ</th>
                        <td><button type="button" class="btn btn-outline-dark space_botton"  data-toggle="modal" data-target="#drawing_modal" style="background-color:silver #c0c0c0;">その他データ</button></td>
                    </tr>
                    <input type="hidden" class="form-control" name="client_drawing_id" value="{{ $clients['client_drawing_id'] }}">
                        <!-- ↓モーダル表示部分↓ -->
                        <div class="modal fade" id="drawing_modal" tabindex="-1" role="dialog" aria-labelledby="drawing" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="drawing">その他データの変更</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>タイトル</label>
                                            <input type="text" class="form-control" name="drawing_title" value="{{ $clients['drawings_image_title'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label>データのインポート</label><br>
                                            <b><font color="red">ファイル形式:jpeg,png,jpg,bmbのみ ファイルサイズ:2MBまで</font></b>
                                            <input type="file" class="form-control-file" name="drawing_import" id="drawing_preview">
                                        </div>
                                        <img id="drawing_img_preview" style="max-width: 450px; max-height: 450px;">
                                        <script>
                                            $('#drawing_preview').on('change', function (e) {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    $("#drawing_img_preview").attr('src', e.target.result);
                                                }
                                                reader.readAsDataURL(e.target.files[0]);
                                            });
                                        </script>
                                        <div class="form-group">
                                            <label>現在のデータ</label>
                                            <img src="{{ url($clients['drawings_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                            <input type="hidden" class="form-control" value="{{ $clients['drawings_image_path'] }}" name="before_drawing">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">変更画面へ</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <script>
                    $('.chosen-select').chosen({
                        width: "320px",
                    });
                    </script>
                </table>

            <div class="text-right">
                <input type="submit" value="修正確認" class="btn btn-info">
            </div>

        
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
        </form>
    </div>
</div>
@endsection
