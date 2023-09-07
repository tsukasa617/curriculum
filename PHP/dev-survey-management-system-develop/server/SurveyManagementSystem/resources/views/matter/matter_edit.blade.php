@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
    <script src="{{ asset('js/matter_edit_value.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">
    <script src="{{ asset('js/client_search.js') }}"></script>

<div class="container">
    <div>
        <span style="font-size: 30px;">法人案件顧客リスト編集</span>
    </div>

    @if (session('error_message'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('error_message') }}</li>
            </ul>
        </div>
    @endif
    <div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <div class="message">
                {{ $error }}
            </div>
        @endforeach
        </ul>
    </div>
    @endif

    <div id="detail_menu">
        @php $authoritys = session()->get('authoritys'); @endphp
        <form action="{{ action('MatterController@edit_check') }}" method="POST" enctype="multipart/form-data">
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
                                        <a href="{{ action('MatterController@delete',['id' => $matters['id']]) }}">
                                            <button type="button" class="btn btn-danger">OK</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div></li>
                        <li><button type="button" onclick="location.href='{{ action('MatterController@all') }}'" class="btn btn-secondary">一覧に戻る</button></li>
                    </ul>
                </div>
            </div>
            
        @php $authoritys = session()->get('authoritys'); @endphp
        <table class="table table-bordered" style="margin-top: 10px;">
            <input type="hidden" name="id" value="{{ $matters['id'] }}">

            <tr>
                <td colspan="2"><h4>＜案件情報＞</h4></td>
            </tr>

            <tr>
                <th>流入経路</th>
                <td>
                    <select name="advertising_name" class="form-control">
                        <option value="{{ $matters->advertising_name }}" selected>{{ $matters->advertising_name }}</option>
                        @foreach ($advertising_name as $val)
                            <option value="{{ $val['advertising_name'] }}">{{ $val['advertising_name'] }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>ID<font color="red">＊</font></th>
                <td><input type="text" class="form-control" name="member" value="{{ $matters['member'] }}" maxlength="10" required></td>
            </tr>
            <tr>
                <th>グループ名</th>
                <td><input type="text" class="form-control" value="{{ $matters['group_name'] }}" name="group_name"></td>
            </tr>
            <tr>
                <th>会社名<font color="red">＊</font></th>
                <td><input type="text" class="form-control" value="{{ $matters['contractor'] }}" name="contractor" required></td>
            </tr>
            <tr>
                <th>契約者名</th>
                <td><input type="text" class="form-control" value="{{ $matters['insurance_policyholder'] }}" name="insurance_policyholder"></td>
            </tr>
            <tr>
                <th>住所<font color="red">＊</font></th>
                <td><input type="text" class="form-control" value="{{ $matters['address'] }}" name="address" required></td>
            </tr>
            <tr>
                <th>建物名</th>
                <td><input type="text" class="form-control" value="{{ $matters['buildingname'] }}" name="buildingname"></td>
            </tr>
            <tr>
                <th>建物種別</th>
                <td><input type="text" class="form-control" value="{{ $matters['property_information'] }}" name="property_information"></td>
            </tr>
            <tr>
                <th>連絡先<font color="red">＊</font></th>
                <td><input type="text" class="form-control" name="contact_method" value="{{ $matters['contact_method'] }}" required></td>
            </tr>
            <tr>
                <th>築年数</th>
                <td><input type="text" class="form-control" name="building_age" value="{{ $matters['building_age'] }}"></td>
            </tr>
            <tr>
                <th>保険会社</th>
                <td><input type="text" class="form-control" name="insurance_company" value="{{ $matters['insurance_company'] }}"></td>
            </tr>
            <tr>
                <th>ステータス</th>
                <td>
                    <select name="status_name" class="form-control">
                        <option value="{{ $matters->status_name }}" selected>{{ $matters->status_number }}:{{ $matters->status_name }}</option>
                        @foreach ($status_name as $val)
                            <option value="{{ $val['status_name'] }}">{{ $val['status_number'] }}:{{ $val['status_name'] }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>アクション日付</th>
                <td><input type="date" class="form-control" name="action_date" value="{{ $matters['action_date'] }}"></td>
            </tr>
            <tr>
                <th>アクション内容</th>
                <td><textarea class="form-control" name="action_note" value="{{ $matters['action_note'] }}"></textarea></td>
            </tr>
            <tr class="col-sm-12 content_position" style="margin-bottom:10px;">
                <th>備考</th>
                <td><textarea class="form-control" name="note" value="{{ $matters['note'] }}"></textarea></td>
            </tr>
            <tr>
                <th>入金予測時期</th>
                <td><input type="date" class="form-control" name="payment_predict_date" value="{{ $matters['payment_predict_date'] }}"></td>
            </tr>
            <tr>
                <th>入金期待値</th>
                <td>
                    <select name="payment_expecte" class="form-control">
                        <option value="{{ $matters['payment_expecte'] }}" selected>{{ $matters['payment_expecte'] }}</option>
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
                <td><input type="text" class="form-control" name="sales_staff" value="{{ $matters['sales_staff'] }}"></td>
            </tr>
            <tr>
                <th>調査会社</th>
                <td>
                    <select name="survey_name" class="form-control">
                        <option value="{{ $matters->survey_name }}" selected>{{ $matters->survey_name }}</option>
                        @foreach ($survey_corps as $val)
                            <option value="{{ $val['survey_name'] }}">{{ $val['survey_name'] }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>取次店</th>
                <td>
                    <select name="trader_id" class="form-control">
                        <option value="{{ $matters->trader_id }}" selected>{{ $matters->trader_id }}:{{ $matters->trader_name }}</option>
                        @foreach ($traders as $val)
                            <option value="{{ $val['id'] }}">{{ $val['id'] }}:{{ $val['trader_name'] }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th>現調担当</th>
                <td><input type="text" class="form-control" name="survey_staff" value="{{ $matters['survey_staff'] }}"></td>
            </tr>
            <tr>
                <th>依頼日</th>
                <td><input type="date" class="form-control" name="request_date" value="{{ $matters['request_date'] }}"></td>
            </tr>
            <tr>
                <th>現調予定日</th>
                <td><input type="date" class="form-control" name="scheduled_survey_date" value="{{ $matters['scheduled_survey_date'] }}"></td>
            </tr>
            <tr>
                <th>現調日</th>
                <td><input type="date" class="form-control" name="survey_date" value="{{ $matters['survey_date'] }}"></td>
            </tr>
            <tr>
                <th>合意書</th>
                <td><input type="date" class="form-control" name="agreement_date" value="{{ $matters['agreement_date'] }}"></td>
            </tr>
            <tr>
                <th>事故報告日</th>
                <td><input type="date" class="form-control" name="accident_date" value="{{ $matters['accident_date'] }}"></td>
            </tr>
            <tr>
                <th>保険申請日</th>
                <td><input type="date" class="form-control" name="insurance_policy_date" value="{{ $matters['insurance_policy_date'] }}"></td>
            </tr>
            <tr>
                <th>認定日</th>
                <td><input type="date" class="form-control" name="certification_date" value="{{ $matters['certification_date'] }}"></td>
            </tr>
            <tr>
                <th>請求日</th>
                <td><input type="date" class="form-control" name="bill_issue_date" value="{{ $matters['bill_issue_date'] }}"></td>
            </tr>
            <tr>
                <th>入金日</th>
                <td><input type="date" class="form-control" name="payment_date" value="{{ $matters['payment_date'] }}"></td>
            </tr>

            <tr>
                <th>¥.見積額<font color="red">＊</font></th>
                <td><label for="quotation_money" style="float:left; margin-right:5px;">¥</label><input type="number" class="form-control" name="quotation_money" value="{{ $matters['quotation_money'] }}" style="width:50%;" id="quotation_money" required></td>
            </tr>
            <tr>
                <th>¥.認定額<font color="red">＊</font></th>
                <td><label for="certification_money" style="float:left; margin-right:5px;">¥</label><input type="number" class="form-control"   name="certification_money" value="{{ $matters['certification_money'] }}" style="width:50%;" id="certification_money" required></td>
            </tr>
            <tr>
                <th>請求手数料（％）<font color="red">＊</font></th>
                <td><label for="fee" style="margin-right: 65%;">%</label><input type="text" class="form-control" name="fee" value="{{ $matters['fee'] }}" style="width:25%;" id="fee" required></td>
            </tr>
            <tr>
                <th>調査会社手数料（％）<font color="red">＊</font></th>
                <td><label for="survey_referral" style="margin-right: 65%;">%</label><input type="text" class="form-control" name="survey_referral" value=" {{ $matters['survey_referral'] }}" style="width:25%;" id="survey_referral" required></td>
            </tr>
            <tr>
                <th>取次店手数料1（％）<font color="red">＊</font></th>
                <td><label for="referral_rate" style="margin-right: 65%;">%</label><input type="text" class="form-control" name="referral_rate" value="{{ $matters['referral_rate'] }}" style="width:25%;" id="referral_rate" required></td>
            </tr>
            <tr>
                <th>取次店手数料2（％）<font color="red">＊</font></th>
                <td><label for="referral_rate_2" style="margin-right: 65%;">%</label><input type="number" class="form-control" value="{{ $matters['referral_rate_2'] }}" name="referral_rate_2" style="width:30%;" id="referral_rate_2" required></td>
            </tr>
            <tr>
                <th>取次店手数料3（％）<font color="red">＊</font></th>
                <td><label for="referral_rate_3" style="margin-right: 65%;">%</label><input type="number" class="form-control" value="{{ $matters['referral_rate_3'] }}" name="referral_rate_3" style="width:30%;" id="referral_rate_3" required></td>
            </tr>

            <tr>
                <td colspan="2"><h4>＜証券データ＞</h4></td>
            </tr>

            <tr>
                <th>保険証券データ</th>
                <td><button type="button" class="btn btn-outline-dark space_botton"  data-toggle="modal" data-target="#insurance_policy_modal" style="background-color:silver #c0c0c0;">保険証券データ</button></td>
            </tr>
            <input type="hidden" class="form-control" name="matter_insurance_policy_id" value="{{ $matters['matter_insurance_policy_id'] }}">
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
                                <input type="text" class="form-control" name="insurance_policy_title" value="{{ $matters['insurance_policies_image_title']}}">
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
                                <img src="{{ url($matters['insurance_policies_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                <input type="hidden" class="form-control" value="{{ $matters['insurance_policies_image_path'] }}" name="before_insurance_policy">
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
            <input type="hidden" class="form-control" name="matter_agreement_id" value="{{ $matters['matter_agreement_id'] }}">
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
                                <input type="text" class="form-control" name="agreement_title" value="{{ $matters['agreements_image_title'] }}">
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
                                <img src="{{ url($matters['agreements_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                <input type="hidden" class="form-control" value="{{ $matters['agreements_image_path'] }}" name="before_agreement">
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
                <td><button type="button" class="btn btn-outline-dark space_botton"  data-toggle="modal" data-target="#report_modal" style="background-color:silver #c0c0c0;">報告書データ</button></td>
            </tr>
            <input type="hidden" class="form-control" name="matter_report_id" value="{{ $matters['matter_report_id'] }}">
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
                                <input type="text" class="form-control" name="report_title" value="{{ $matters['reports_image_title'] }}">
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
                                <img src="{{ url($matters['reports_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                <input type="hidden" class="form-control" value="{{ $matters['reports_image_path'] }}" name="before_report">
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
            <input type="hidden" class="form-control" name="matter_quotation_id" value="{{ $matters['matter_quotation_id'] }}">
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
                                <input type="text" class="form-control" name="quotation_title" value="{{ $matters['quotations_image_title'] }}">
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
                                <img src="{{ url($matters['quotations_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                <input type="hidden" class="form-control" value="{{ $matters['quotations_image_path'] }}" name="before_quotation">
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
            <input type="hidden" class="form-control" name="matter_certification_id" value="{{ $matters['matter_certification_id'] }}">
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
                                <input type="text" class="form-control" name="certification_title" value="{{ $matters['certifications_image_title'] }}">
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
                                <img src="{{ url($matters['certifications_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                <input type="hidden" class="form-control" value="{{ $matters['certifications_image_path'] }}" name="before_certification">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">変更画面へ</button>
                        </div>
                    </div>
                </div>
            </div>

            <tr>
                <th>請求書データ</th>
                <td><button type="button" class="btn btn-outline-dark space_botton" data-toggle="modal" data-target="#bill_issue_modal" style="background-color:silver#c0c0c0;">請求書データ</button></td>
            </tr>
            <input type="hidden" class="form-control" name="matter_bill_issue_id" value="{{ $matters['matter_bill_issue_id'] }}">
            <!-- ↓モーダル表示部分↓ -->
            <div class="modal fade" id="bill_issue_modal" tabindex="-1" role="dialog" aria-labelledby="bill_issue" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bill_issue">請求書データの変更</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>タイトル</label>
                                <input type="text" class="form-control" name="bill_issue_title" value="{{ $matters['bill_issues_image_title'] }}">
                            </div>
                            <div class="form-group">
                                <label>データのインポート</label><br>
                                <b><font color="red">ファイル形式:jpeg,png,jpg,bmbのみ ファイルサイズ:2MBまで</font></b>
                                <input type="file" class="form-control-file" name="bill_issue_import" id="bill_issue_preview">
                            </div>
                            <img id="bill_issue_img_preview" style="max-width: 450px; max-height: 450px;">
                            <script>
                                $('#bill_issue_preview').on('change', function (e) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        $("#bill_issue_img_preview").attr('src', e.target.result);
                                    }
                                    reader.readAsDataURL(e.target.files[0]);
                                });
                            </script>
                            <div class="form-group">
                                <label>現在のデータ</label>
                                <img src="{{ url($matters['bill_issues_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                <input type="hidden" class="form-control" value="{{ $matters['bill_issues_image_path'] }}" name="before_bill_issue">
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
            <input type="hidden" class="form-control" name="matter_drawing_id" value="{{ $matters['matter_drawing_id'] }}">
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
                                <input type="text" class="form-control" name="drawing_title" value="{{ $matters['drawings_image_title'] }}">
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
                                <img src="{{ url($matters['drawings_image_path']) }}" alt="" style="max-width: 450px; max-height: 450px;"></td>
                                <input type="hidden" class="form-control" value="{{ $matters['drawings_image_path'] }}" name="before_drawing">
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
            <input type="submit" value="変更確認" class="btn btn-info">
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
</div>
@endsection