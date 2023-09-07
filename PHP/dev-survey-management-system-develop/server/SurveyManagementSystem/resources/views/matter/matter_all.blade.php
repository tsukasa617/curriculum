@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

 <script src="{{ asset('js/checkbox.js') }}"></script>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">

    <div>
        <span style="font-size: 30px;">法人案件顧客リスト</span>
    </div>

    {{--権限の取得--}}
    @php $authoritys = session()->get('authoritys'); @endphp

    @if (session('success_message'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session('success_message') }}</li>
            </ul>
        </div>
    @endif
    @if (session('error_message'))
    <div class="alert alert-done">
        <ul>
            <!-- 登録・更新失敗メッセージ -->
            <li>{{ session('error_message') }}</li>
        </ul>
    </div>
    @endif

    <div>
        <ul class="matter_all_sub">
            <div class="matter_all_search" style="margin-left: -5px;">
                <form action="{{ action('MatterController@filter_search') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="matter_data" value="{{ $matter_data }}">
                    <li class="list">
                        <input type="text" class="form-control" name="search" placeholder="キーワード検索">
                    </li>
                    <li>
                        <input type='submit' class="btn btn-primary" value='検索'>
                    </li>
                    @foreach($authoritys as $authorities)
                        @if($authorities == "リグラント営業" || $authorities == "全画面")
                            <li>
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modal1">複数条件検索</button>
                            </li>
                        @endif
                    @endforeach
                    <!-- ↓モーダル表示部分↓ -->
                    <li>
                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="label1">条件を入力してください。</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>ステータス</label>
                                            <select name="matter_status_id" class="form-control survey">
                                                <option value="" selected>選択して下さい。</option>
                                                @foreach ($status_name as $value)
                                                    <option value="{{ $value['id'] }}">{{ $value['status_number'] }}:{{ $value['status_name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>アクション日付</label>
                                            <input type="date" class="form-control" name="action_date">
                                        </div>
                                        <div class="form-group">
                                            <label>アクション内容</label>
                                            <input type="text" class="form-control" name="action_note">
                                        </div>
                                        <div class="form-group">
                                            <label>備考</label>
                                            <input type="text" class="form-control" name="note">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                        <input type='submit' name="sort" class="btn btn-primary" value='複数検索'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <select name="column" class="form-control status_name">
                            <option value="scheduled_survey_date" selected>現調予定日</option>
                            <option value="survey_date">現調日</option>
                        </select>
                    </li>
                    <li>
                        <input type='submit' name="sort" class="btn btn-primary" value='昇順'>
                    </li>
                    <li>
                        <input type='submit' name="sort" class="btn btn-primary" value='降順'>
                    </li>
                </form>
                @foreach($authoritys as $authorities)
                    @if($authorities == "削除")
                        <li>
                            <input type='button' class="btn btn-danger" value='削除' id='forget_value' style="display: none">
                        </li>
                    @endif
                @endforeach
                <li>
                    <input type='button' class="btn btn-primary" value='更新' id='get_value' style="display: none">
                </li>
            </div>
            <div>
                <button class="btn btn-outline-secondary" style="margin-right:10px;"><a href="{{ action('MatterController@create') }}">新規登録</a></button>
            </div>
            @foreach($authoritys as $authorities)
                @if($authorities == "ユーザー周り")
                    <div style="margin-right: -5px;">
                        <button class="btn btn-outline-secondary"><a href="{{ action('MatterController@export_csv') }}">CSV出力</a></button>
                    </div>
                @endif
            @endforeach
        </ul>
    </div>
    
    <div>
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th style="width: 2em"><input type="checkbox" name="allchecked" id="all"></th>
                    <!-- @foreach($authoritys as $authorities)
                        @if($authorities == "削除")
                            <th class="detail_space"></th>
                        @endif
                    @endforeach -->
                    <th class="detail_space"></th>
                    <th class="detail_space"></th>
                    @foreach($authoritys as $authorities)
                        @if($authorities == "編集")
                            <th class="edit_space"></th>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "リグラント営業")
                            <th>営業担当</th>
                            <th>流入経路</th>
                            <th>調査会社</th>
                            <th>ID</th>
                            <th>グループ</th>
                            <th>会社名</th>
                            <th>建物(名称)</th>
                            <th>保険契約者名</th>
                            <th>施設名</th>
                            <th>住所</th>
                            <th>ステータス</th>
                            <th>アクション日付</th>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "調査会社")
                            <th>ID</th>
                            <th>グループ</th>
                            <th>会社名</th>
                            <th>建物(名称)</th>
                            <th>保険契約者名</th>
                            <th>施設名</th>
                            <th>住所</th>
                            <th>連絡方法</th>
                            <th>現調日</th>
                            <th>調査会社報酬額（％）</th>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "全画面")
                            <th>ID</th>
                            <th>グループ</th>
                            <th>会社名</th>
                            <th>建物(名称)</th>
                            <th>保険契約者名</th>
                            <th>施設名</th>
                            <th>住所</th>
                            <th>連絡方法</th>
                            <th>取次店</th>
                            <th>保険会社</th>
                            <th>台風名</th>
                            <th>風速</th>
                            <th>風災</th>
                            <th>震災</th>
                            <th>ステータス</th>
                            <th>備考</th>
                            <th>図面</th>
                            <th>合意書（例:10/01）</th>
                            <th>保険証券</th>
                            <th>商談日</th>
                            <th>現調日</th>
                            <th>現調担当</th>
                            <th>工事コンサル</th>
                            <th>事故報告（例:10/01）</th>
                            <th>請求用紙到着（民間）</th>
                            <th>写真UP（例:10/01）</th>
                            <th>報告書完成日（例:10/01）</th>
                            <th>見積書完成日（例:10/01）</th>
                            <th>発送日（例:10/01）</th>
                            <th>発送先(保険会社/お客様)</th>
                            <th>見積額</th>
                            <th>鑑定日</th>
                            <th>認定日（例:10/01）</th>
                            <th>認定額</th>
                            <th>顧客請求書送付（例:10/01）</th>
                            <th>入金日（例:10/01）</th>
                            <th>入金額</th>
                            <th>手数料</th>
                            <th>アクション日付</th>
                            <th>アクション内容</th>
                            <th>アクションログ</th>
                            <th>営業担当</th>
                            <th>案件窓口</th>
                            <th>取次店</th>
                            <th>紹介率</th>
                            <th>紹介率合計</th>
                            <th>取次店2</th>
                            <th>紹介率</th>
                            <th>取次店3</th>
                            <th>紹介率</th>
                            <th>調査会社</th>
                            <th>調査会社手数料</th>
                            <th>収益額</th>
                            <th>保険証券データ</th>
                            <th>合意書データ</th>
                            <th>報告書データ</th>
                            <th>見積書データ</th>
                            <th>認定書データ</th>
                            <th>請求書データ</th>
                            <th>図面データ</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody class="table">
                @foreach($matters as $matter)
                    @if($matter['status_name'] == "クロージングNG" || $matter['status_name'] == "クロージング前NG" || $matter['status_name'] == "現調前NG" ||     $matter['status_name'] == "現調後NG" || $matter['status_name'] == "被害なし" || $matter['status_name'] == "無責" || $matter['status_name'] == "時効NG")
                        <tr class="chnage-ng-color">
                    @elseif($matter['status_name'] == "完了")
                        <tr class="chnage-finished-color">
                    @elseif($matter['caution'] == '▲')
                        <tr class="chnage-error-color">
                    @else
                        <tr>
                    @endif
                            <td class="check"><input type="checkbox" name="chk[]" value="{{ $matter['id'] }}" class="is"></td>
                            <!-- @foreach($authoritys as $authorities)
                                @if($authorities == "削除")
                                    <td><button onclick="location.href='{{ action('MatterController@detail',['id'=>$matter['id']]) }}'" class="btn-sm btn-success">詳細</button></td>
                                @endif
                            @endforeach -->
                            <!-- 重要マーク -->
                            <td>
                                @if($matter['important'] == '☆')
                                    <span class="material-icons important_check">star_border</span>
                                @else
                                    <span class="material-icons important_check import_color">star_rate</span>
                                @endif
                                <input type="hidden" name="important_val" class="important_val" value="{{ $matter['important'] }}">
                            </td>
                            <!-- 注意マーク -->
                            <td>
                                @if($matter['caution'] == '△')
                                    <span class="material-icons caution_check">warning_amber</span>
                                @else
                                    <span class="material-icons caution_check">report_problem</span>
                                @endif
                            </td>
                            
                            @foreach($authoritys as $authorities)
                                @if($authorities == "編集")
                                    <td><button onclick="location.href='{{ action('MatterController@edit',['id'=>$matter['id']]) }}'" class="btn-sm btn-info">編集</button></td>
                                @endif
                            @endforeach

                            @foreach($authoritys as $authorities)
                                @if($authorities == "リグラント営業")
                                    <!-- 営業担当 -->
                                    <td>{{ $matter['sales_staff'] }}</td>
                                    <!-- 流入経路 -->
                                    <td>{{ $matter['advertising'] }}</td>
                                    <!-- 調査会社 -->
                                    <td>{{ $matter['survey_name'] }}</td>
                                    <!-- ID -->
                                    <td>{{ $matter['member'] }}</td>
                                    <!-- グループ -->
                                    <td>{{ $matter['group_name'] }}</td>
                                    <!-- 会社名 -->
                                    <td>{{ $matter['contractor'] }}</td>
                                    <!-- 建物(名称) -->
                                    <td>{{ $matter['property_information'] }}</td>
                                    <!-- 保険契約者名 -->
                                    <td>{{ $matter['insurance_policyholder'] }}</td>
                                    <!-- 施設名 -->
                                    <td>{{ $matter['buildingname'] }}</td>
                                    <!-- 住所 -->
                                    <td>{{ $matter['address'] }}</td>
                                    <!-- ステータス -->
                                    <td>
                                        <span>{{ $matter['status_number'] }}：{{ $matter['status_name'] }}</span>
                                        <input type="hidden" name="status_all_id" class="status_all_id" value="{{ $matter['matter_status_id'] }}">
                                            <i class="material-icons" style="cursor: pointer">create</i>
                                            {{-- ボタンを押したら切り替え --}}
                                            <select name="status_name" class="form-control status_name" name="sta[]" style="width: auto;display: none;">
                                                <option value="{{ $matter['status_name'] }}" selected>{{ $matter['status_number'] }}：{{ $matter['status_name'] }}</option>
                                                @foreach ($status_name as $val)
                                                    <option value="{{ $val['id'] }}") >{{ $val['status_number'] }}：{{ $val['status_name'] }}</option>
                                                @endforeach
                                            </select>
                                    </td>
                                    <!-- アクション日付 -->
                                    <td>{{ substr($matter['action_date'], 5) }}</td>
                                @endif
                            @endforeach

                            @foreach($authoritys as $authorities)
                                @if($authorities == "調査会社")
                                    <!-- ID -->
                                    <td>{{ $matter['member'] }}</td>
                                    <!-- グループ -->
                                    <td>{{ $matter['group_name'] }}</td>
                                    <!-- 会社名 -->
                                    <td>{{ $matter['contractor'] }}</td>
                                    <!-- 建物(名称) -->
                                    <td>{{ $matter['property_information'] }}</td>
                                    <!-- 保険契約者名 -->
                                    <td>{{ $matter['insurance_policyholder'] }}</td>
                                    <!-- 施設名 -->
                                    <td>{{ $matter['buildingname'] }}</td>
                                    <!-- 住所 -->
                                    <td>{{ $matter['address'] }}</td>
                                    <!-- 連絡方法 -->
                                    <td>{{ $matter['contact_method'] }}</td>
                                    <!-- 現調日（例:10/01） -->
                                    <td>{{ substr($matter['survey_date'], 5) }}</td>
                                    <!-- 調査会社報酬額（％） -->
                                    <td>{{ $matter['survey_referral'] }}%</td>
                                @endif
                            @endforeach

                            @foreach($authoritys as $authorities)
                                @if($authorities == "全画面")
                                    <!-- ID -->
                                    <td>{{ $matter['member'] }}</td>
                                    <!-- グループ -->
                                    <td>{{ $matter['group_name'] }}</td>
                                    <!-- 会社名 -->
                                    <td>{{ $matter['contractor'] }}</td>
                                    <!-- 建物(名称) -->
                                    <td>{{ $matter['property_information'] }}</td>
                                    <!-- 保険契約者名 -->
                                    <td>{{ $matter['insurance_policyholder'] }}</td>
                                    <!-- 施設名 -->
                                    <td>{{ $matter['buildingname'] }}</td>
                                    <!-- 住所 -->
                                    <td>{{ $matter['address'] }}</td>
                                    <!-- 連絡方法 -->
                                    <td>{{ $matter['contact_method'] }}</td>
                                    <!-- 取次店 -->
                                    <td>{{ $matter['trader_name'] }}</td>
                                    <!-- 保険会社 -->
                                    <td>{{ $matter['insurance_company'] }}</td>
                                    <!-- 台風名 -->
                                    <td>{{ $matter['typhoon_name'] }}</td>
                                    <!-- 風速 -->
                                    <td>{{ $matter['wind_speed'] }}</td>
                                    <!-- 風災 -->
                                    @if($matter['wind_disaster'] == 0)
                                        <td>✖</td>
                                    @else✖
                                        <td>〇</td>
                                    @endif
                                    <!-- 震災 -->
                                    @if($matter['earthquake_disaster'] == 0)
                                        <td>✖</td>
                                    @else✖
                                        <td>〇</td>
                                    @endif
                                    <!-- ステータス -->
                                    <td>
                                        <span>{{ $matter['status_number'] }}：{{ $matter['status_name'] }}</span>
                                        <input type="hidden" name="status_all_id" class="status_all_id" value="{{ $matter['matter_status_id'] }}">
                                            <i class="material-icons" style="cursor: pointer">create</i>
                                            {{-- ボタンを押したら切り替え --}}
                                            <select name="status_name" class="form-control status_name" name="sta[]" style="width: auto;display: none;">
                                                <option value="{{ $matter['status_name'] }}" selected>{{ $matter['status_number'] }}：{{ $matter['status_name'] }}</option>
                                                @foreach ($status_name as $val)
                                                    <option value="{{ $val['id'] }}") >{{ $val['status_number'] }}：{{ $val['status_name'] }}</option>
                                                @endforeach
                                            </select>
                                    </td>
                                    <!-- 備考 -->
                                    <td>{{ $matter['note'] }}</td>
                                    <!-- 図面 -->
                                    @if($matter['drawing']  == 0)
                                        <td>-</td>
                                    @else
                                        <td>〇</td>
                                    @endif
                                    <!-- 合意書（例:10/01） -->
                                    <td>{{ substr($matter['agreement_date'], 5) }}</td>
                                    <!-- 保険証券 -->
                                    @if($matter['insurance_policy'] == 0)
                                        <td>-</td>
                                    @else
                                        <td>〇</td>
                                    @endif
                                    <!-- 商談日 -->
                                    <td>{{ substr($matter['scheduled_survey_date'], 5) }}</td>
                                    <!-- 現調日（例:10/01） -->
                                    <td>{{ substr($matter['survey_date'], 5) }}</td>
                                    <!-- 現調担当 -->
                                    <td>{{ $matter['survey_staff'] }}</td>
                                    <!-- 工事コンサル -->
                                    @if($matter['construction_consultant'] == 0)
                                        <td>コンサル</td>
                                    @else
                                        <td>工事</td>
                                    @endif
                                    <!-- 事故報告（例:10/01） -->
                                    <td>{{ substr($matter['accident_date'], 5) }}</td>
                                    <!-- 請求用紙到着（民間）（例:10/01） -->
                                    <td>{{ substr($matter['billing_receipt_date'], 5) }}</td>
                                    <!-- 写真UP（例:10/01） -->
                                    <td>{{ substr($matter['picture_date'], 5) }}</td>
                                    <!-- 報告書完成日（例:10/01） -->
                                    <td>{{ substr($matter['report_completed_date'], 5) }}</td>
                                    <!-- 見積書完成日（例:10/01） -->
                                    <td>{{ substr($matter['quotation_completed_date'], 5) }}</td>
                                    <!-- 発送日（例:10/01）	 -->
                                    <td>{{ substr($matter['submit_sending_date'], 5) }}</td>
                                    <!-- 発送先(保険会社/お客様)-->
                                    <td>{{ $matter['document_submit_to'] }}</td>
                                    <!-- 見積額 -->
                                    <td>{{ number_format($matter['quotation_money']) }}円</td>
                                    <!-- 鑑定日 -->
                                    <td>{{ substr($matter['judge_date'], 5) }}</td>
                                    <!-- 認定日（例:10/01） -->
                                    <td>{{ substr($matter['certification_date'], 5) }}</td>
                                    <!-- 認定額 -->
                                    <td>{{ number_format($matter['certification_money']) }}円</td>
                                    <!-- 顧客請求書送付(例:10/01) -->
                                    <td>{{ substr($matter['customer_invoice_date'], 5) }}</td>
                                    <!-- 入金日（例:10/01） -->
                                    <td>{{ substr($matter['payment_date'], 5) }}</td>
                                    <!-- 入金額 -->
                                    <td>{{ number_format($matter['payment_money']) }}円</td>
                                    <!-- 手数料 -->
                                    <td>{{ $matter['fee'] }}%</td>
                                    <!-- アクション日付 -->
                                    <td>{{ substr($matter['action_date'], 5) }}</td>
                                    <!-- アクション内容 -->
                                    <td>{{ $matter['action_note'] }}</td>
                                    <!-- アクションログ -->
                                    <td>{{ $matter['action_log'] }}</td>
                                    <!-- 営業担当 -->
                                    <td>{{ $matter['sales_staff'] }}</td>
                                    <!-- 案件窓口 -->
                                    <td>{{ $matter['contact_matter'] }}</td>
                                    <!-- 取次店 -->
                                    <td>{{ $matter['trader_name'] }}</td>
                                    <!-- 紹介率 -->
                                    <td>{{ $matter['referral_rate'] }}%</td>
                                    <!-- 紹介率合計 -->
                                    <td>{{ $matter['referral_rate_total'] }}%</td>
                                    <!-- 取次店2 -->
                                    <td>{{ $matter['agency_store_2_name'] }}</td>
                                    <!-- 紹介率 -->
                                    <td>{{ $matter['referral_rate_2'] }}%</td>
                                    <!-- 取次店3 -->
                                    <td>{{ $matter['agency_store_3_name'] }}</td>
                                    <!-- 紹介率 -->
                                    <td>{{ $matter['referral_rate_3'] }}%</td>
                                    <!-- 調査会社 -->
                                    <td>{{ $matter['survey_name'] }}</td>
                                    <!-- 調査会社手数料 -->
                                    <td>{{ $matter['survey_referral'] }}%</td>
                                    <!-- 利益額 -->
                                    <td>{{ number_format($matter['profit_money']) }}円</td>
                                    <!-- 保険証券画像 -->
                                    <td><a href="../{{ $matter['insurance_policies_image_path'] }}">{{ $matter['insurance_policies_image_title'] }}</a></td>
                                    <!-- 合意書画像 -->
                                    <td><a href="../{{ $matter['agreements_image_path'] }}">{{ $matter['agreements_image_title'] }}</a></td>
                                    <!-- 報告書画像 -->
                                    <td><a href="../{{ $matter['reports_image_path'] }}">{{ $matter['reports_image_title'] }}</a></td>
                                    <!-- 見積書画像 -->
                                    <td><a href="../{{ $matter['quotations_image_path'] }}">{{ $matter['quotations_image_title'] }}</a></td>
                                    <!-- 認定書画像 -->
                                    <td><a href="../{{ $matter['certifications_image_path'] }}">{{ $matter['certifications_image_title'] }}</a></td>
                                    <!-- 請求書画像 -->
                                    <td><a href="../{{ $matter['bill_issues_image_path'] }}">{{ $matter['bill_issues_image_title'] }}</a></td>
                                    <!-- 図面画像 -->
                                    <td><a href="../{{ $matter['drawings_image_path'] }}">{{ $matter['drawings_image_title'] }}</a></td>
                                @endif
                            @endforeach
                        </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $matters->links() }}
    </div>
</div>
@endsection