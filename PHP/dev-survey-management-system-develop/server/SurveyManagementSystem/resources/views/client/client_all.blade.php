@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<script src="{{ asset('js/checkbox_client.js') }}"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <div>
        <span style="font-size: 30px;">個人案件顧客リスト</span>
    </div>

    {{--権限の取得--}}
    @php $authoritys = session()->get('authoritys');@endphp

    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
            <!-- 登録・更新成功メッセージ -->
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
    <div style="margin-right: 5px;">
        <ul class="matter_all_sub">
            <div class="matter_all_search" style="margin-left:-5px;">
                <form action="{{ action('ClientController@filter_search') }}" method="POST">
                {{ csrf_field() }}
                    <input type="hidden" name="client_data" value="{{ $client_data }}">
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
                                            <select name="client_status_id" class="form-control survey">
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
                    @foreach($authoritys as $authorities)
                        @if($authorities == "リグラント営業")
                            <li>
                                <select name="column" class="form-control status_name">
                                    <option value="action_date" selected>アクション日付</option>
                                </select>
                            </li>
                        @endif
                    @endforeach
                    @foreach($authoritys as $authorities)
                        @if($authorities == "調査会社")
                            <li>
                                <select name="column" class="form-control status_name">
                                    <option value="submit_date" selected>連結日</option>
                                    <option value="survey_date">現調日</option>
                                </select>
                            </li>
                        @endif
                    @endforeach
                    @foreach($authoritys as $authorities)
                        @if($authorities == "全画面")
                            <li>
                                <select name="column" class="form-control status_name">
                                    <option value="scheduled_survey_date" selected>現調予定日</option>
                                    <option value="survey_date">現調日</option>
                                </select>
                            </li>
                        @endif
                    @endforeach
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
                <button class="btn btn-outline-secondary" style="margin-right:10px;"><a href="{{ action('ClientController@create') }}">新規登録</a></button>
            </div>
            @foreach($authoritys as $authorities)
                @if($authorities == "ユーザー周り")
                    <div style="margin-right:-5px;">
                        <button class="btn btn-outline-secondary"><a href="{{ action('ClientController@export_csv') }}">CSV出力</a></button>
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
                            <th class="detail_space"></th>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "リグラント営業")
                            <th>営業担当</th>
                            <th>流入フラグ</th>
                            <th>調査会社</th>
                            <th>ID</th>
                            <th>氏名</th>
                            <th>住所</th>
                            <th>メールアドレス</th>
                            <th>火災保険</th>
                            <th>現状ST</th>
                            <th>アクション日付</th>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "調査会社")
                            <th>連結日</th>
                            <th>ID</th>
                            <th>氏名</th>
                            <th>連絡先</th>
                            <th>住所</th>
                            <th>メールアドレス</th>
                            <th>火災保険</th>
                            <th>現調日</th>
                            <th>調査会社報酬額（％）</th>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "全画面")
                            <th>連結日</th>
                            <th>流入フラグ</th>
                            <th>ID</th>
                            <th>氏名</th>
                            <th>住所</th>
                            <th>物件名</th>
                            <th>連絡先</th>
                            <th>メールアドレス</th>
                            <th>火災保険</th>
                            <th>保険会社</th>
                            <th>築年数</th>
                            <th>地震 有/無</th>
                            <th>ステータス</th>
                            <th>アクション日付</th>
                            <th>アクション内容</th>
                            <th>備考</th>
                            <th>入金予測時期</th>
                            <th>入金期待値</th>
                            <th>営業担当</th>
                            <th>調査会社</th>
                            <th>現調担当</th>
                            <th>依頼日</th>
                            <th>現調予定日</th>
                            <th>現調日</th>
                            <th>合意書</th>
                            <th>事故報告</th>
                            <th>保険申請日</th>
                            <th>認定日</th>
                            <th style="text-align:center;">清算<br>（請求書発行）</th>
                            <th>入金日</th>
                            <th>クオカード送付日</th>
                            <th>見積額</th>
                            <th>認定額</th>
                            <th>見積額の認定率</th>
                            <th>請求手数料（％）</th>
                            <th>入金額</th>
                            <th>調査会社手数料（％）</th>
                            <th>調査会社支払額</th>
                            <th>取次店手数料（％）</th>
                            <th>取次店支払額</th>
                            <th>利益額</th>
                            <th>保険証券データ</th>
                            <th>合意書データ</th>
                            <th>報告書データ</th>
                            <th>見積データ</th>
                            <th>認定書データ</th>
                            <th>その他データ</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody class="table">
                @foreach($clients as $client)
                    @if($client['status_name'] == "クロージングNG" || $client['status_name'] == "クロージング前NG" || $client['status_name'] == "現調前NG" ||     $client['status_name'] == "現調後NG" || $client['status_name'] == "被害なし" || $client['status_name'] == "無効" || $client['status_name'] == "時効NG")
                        <tr class="chnage-ng-color">
                    @elseif($client['status_name'] == "完了")
                        <tr class="chnage-finished-color">
                    @elseif($client['caution'] == '▲')
                        <tr class="chnage-error-color">
                    @else
                        <tr>
                    @endif
                    <td class="check">
                        <input type="checkbox" name="chk[]" value="{{ $client['id'] }}" class="is">
                    </td>
                    <!-- @foreach($authoritys as $authorities)
                        @if($authorities == "削除")
                            <td>
                                <button onclick="location.href='{{ action('ClientController@detail', ['id' => $client['id']]) }}'" class="btn-sm btn-success">詳細</button>
                            </td>
                        @endif
                    @endforeach -->
                    <!-- 重要マーク -->
                    <td>
                        @if($client['important'] == '☆')
                            <span class="material-icons important_check">star_border</span>
                        @else
                            <span class="material-icons important_check import_color">star_rate</span>
                        @endif
                        <input type="hidden" name="important_val" class="important_val" value="{{ $client['important'] }}">
                    </td>
                    <!-- 注意マーク -->
                    <td>
                        @if($client['caution'] == '△')
                            <span class="material-icons caution_check">warning_amber</span>
                        @else
                            <span class="material-icons caution_check">report_problem</span>
                        @endif
                    </td>
                    @foreach($authoritys as $authorities)
                        @if($authorities == "編集")
                            <td>
                                <button onclick="location.href='{{ action('ClientController@edit', ['id' => $client['id']]) }}'" class="btn-sm btn-info">編集</button>
                            </td>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "リグラント営業")
                            <!-- 営業担当 -->
                            <td>{{ $client['sales_staff'] }}</td>
                            <!-- 流入フラグ -->
                            <td>{{ $client['advertising'] }}</td>
                            <!-- 調査会社 -->
                            <td>{{ $client['survey_name'] }}</td>
                            <!-- ID -->
                            <td>{{ $client['member'] }}</td>
                            <!-- 氏名 -->
                            <td>{{ $client['contractor'] }}</td>
                            <!-- 住所 -->
                            <td>{{ $client['address'] }}</td>
                            <!-- メールアドレス -->
                            <td>{{ $client['mail_address'] }}</td>
                            <!-- 火災保険加入状況 -->
                            <td>
                            @if($client["fire_insurance_flg"] == '0')
                                @php print '未加入'; @endphp
                            @elseif($client["fire_insurance_flg"] == '1')
                                @php print '加入している'; @endphp
                            @else
                                @php print ''; @endphp
                            @endif
                            </td>
                            <!-- 現状ST -->
                            <td>
                                <span>{{ $client['status_number'] }}：{{ $client['status_name'] }}</span>
                                <input type="hidden" name="status_all_id" class="status_all_id" value="{{ $client['client_status_id'] }}">
                                    <i class="material-icons" style="cursor: pointer">create</i>
                                    {{-- ボタンを押したら切り替え --}}
                                    <select name="status_name" class="form-control status_name" name="sta[]" style="width: auto;display: none;">
                                        <option value="{{ $client['status_name'] }}" selected>{{ $client['status_number'] }}：{{ $client['status_name'] }}</option>
                                        @foreach ($status_name as $val)
                                            <option value="{{ $val['id'] }}") >{{ $val['status_number'] }}：{{ $val['status_name'] }}</option>
                                        @endforeach
                                    </select>
                            </td>
                            <!-- アクション日付 -->
                            <td>{{ substr($client['action_date'], 5) }}</td>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "調査会社")
                            <!-- 連結日 -->
                            <td>{{ substr($client['submit_date'], 5) }}</td>
                            <!-- ID -->
                            <td>{{ $client['member'] }}</td>
                            <!-- 氏名 -->
                            <td>{{ $client['contractor'] }}</td>
                            <!-- 連絡先 -->
                            <td>{{ $client['contractor_contact'] }}</td>
                            <!-- 住所 -->
                            <td>{{ $client['address'] }}</td>
                            <!-- メールアドレス -->
                            <td>{{ $client['mail_address'] }}</td>
                            <!-- 火災保険加入状況 -->
                            <td>
                            @if($client["fire_insurance_flg"] == '0')
                                @php print '未加入'; @endphp
                            @elseif($client["fire_insurance_flg"] == '1')
                                @php print '加入している'; @endphp
                            @else
                                @php print ''; @endphp
                            @endif
                            </td>
                            <!-- 現調日 -->
                            <td>{{ substr($client['survey_date'], 5) }}</td>
                            <!-- 調査会社報酬額（％） -->
                            <td>{{ $client['survey_referral'] }}%</td>
                        @endif
                    @endforeach

                    @foreach($authoritys as $authorities)
                        @if($authorities == "全画面")
                            <!-- 連結日 -->
                            <td>{{ substr($client['submit_date'], 5) }}</td>
                            <!-- 流入フラグ -->
                            <td>{{ $client['advertising'] }}</td>
                            <!-- ID -->
                            <td>{{ $client['member'] }}</td>
                            <!-- 氏名 -->
                            <td>{{ $client['contractor'] }}</td>
                            <!-- 住所 -->
                            <td>{{ $client['address'] }}</td>
                            <!-- 物件名 -->
                            <td>{{ $client['buildingname'] }}</td>
                            <!-- 連絡先 -->
                            <td>{{ $client['contractor_contact'] }}</td>
                            <!-- メールアドレス -->
                            <td>{{ $client['mail_address'] }}</td>
                            <!-- 火災保険加入状況 -->
                            {{-- {{ dd($clients)}} --}}
                            <td>
                            @if($client["fire_insurance_flg"] == '0')
                                @php print '未加入'; @endphp
                            @elseif($client["fire_insurance_flg"] == '1')
                                @php print '加入している'; @endphp
                            @else
                                @php print ''; @endphp
                            @endif
                            </td>
                            <!-- 保険会社 -->
                            <td>{{ $client['insurance_company'] }}</td>
                            <!-- 築年数 -->
                            <td>{{ $client['building_age'] }}</td>
                            <!-- 地震 有/無 -->
                            <td>
                                @if($client['earthquake_flg'] == 0)
                                    @php print '無'; @endphp
                                @else
                                    @php print '有'; @endphp
                                @endif
                            </td>
                            <!-- 現状ST -->
                            <td>
                                <span>{{ $client['status_number'] }}：{{ $client['status_name'] }}</span>
                                <input type="hidden" name="status_all_id" class="status_all_id" value="{{ $client['client_status_id'] }}">
                                    <i class="material-icons" style="cursor: pointer">create</i>
                                    {{-- ボタンを押したら切り替え --}}
                                    <select name="status_name" class="form-control status_name" name="sta[]" style="width: auto;display: none;">
                                        <option value="{{ $client['status_name'] }}" selected>{{ $client['status_number'] }}：{{ $client['status_name'] }}</option>
                                        @foreach ($status_name as $val)
                                            <option value="{{ $val['id'] }}") >{{ $val['status_number'] }}：{{ $val['status_name'] }}</option>
                                        @endforeach
                                    </select>
                            </td>
                            <!-- アクション日付 -->
                            <td>{{ substr($client['action_date'], 5) }}</td>
                            <!-- アクション内容 -->
                            <td>{{ $client['action_note'] }}</td>
                            <!-- 備考 -->
                            <td>{{ $client['note'] }}</td>
                            <!-- 入金予測時期 -->
                            <td>{{ substr($client['payment_predict_date'], 5) }}</td>
                            <!-- 入金期待値 -->
                            <td>{{ $client['payment_expecte'] }}</td>
                            <!-- 営業担当 -->
                            <td>{{ $client['sales_staff'] }}</td>
                            <!-- 調査会社 -->
                            <td>{{ $client['survey_name'] }}</td>
                            <!-- 現調担当 -->
                            <td>{{ $client['survey_staff'] }}</td>
                            <!-- 依頼日 -->
                            <td>{{ substr($client['request_date'], 5) }}</td>
                            <!-- 調査予定日 -->
                            <td>{{ substr($client['scheduled_survey_date'], 5) }}</td>
                            <!-- 現調日 -->
                            <td>{{ substr($client['survey_date'], 5) }}</td>
                            <!-- 合意書 -->
                            <td>{{ substr($client['agreement_date'], 5) }}</td>
                            <!-- 事故報告日 -->
                            <td>{{ substr($client['accident_date'], 5) }}</td>
                            <!-- 保険申請日 -->
                            <td>{{ substr($client['insurance_policy_date'], 5) }}</td>
                            <!-- 認定日 -->
                            <td>{{ substr($client['certification_date'], 5) }}</td>
                            <!-- 清算（請求書発行日） -->
                            <td>{{ substr($client['bill_issue_date'], 5) }}</td>
                            <!-- 入金日 -->
                            <td>{{ substr($client['payment_date'], 5) }}</td>
                            <!-- クオカード送付日 -->
                            <td>{{ substr($client['quo_card_date'], 5) }}</td>
                            <!-- 見積額 -->
                            <td>{{ number_format($client['quotation_money']) }}円</td>
                            <!-- 認定額 -->
                            <td>{{ number_format($client['certification_money']) }}円</td>
                            <!-- 見積額の認定率 -->
                            <td>{{ $client['certification_money_probability'] }}%</td>
                            <!-- 請求手数料（％） -->
                            <td>{{ $client['client_fee'] }}%</td>
                            <!-- 入金額 -->
                            <td>{{ number_format($client['payment_money']) }}円</td>
                            <!-- 調査会社手数料（％）-->
                            <td>{{ $client['survey_referral'] }}%</td>
                            <!-- 調査会社支払額 -->
                            <td>{{ number_format($client['survey_payment_money']) }}円</td>
                            <!-- 取次店手数料（％） --> 
                            <td>{{ $client['trader_referral'] }}%</td>
                            <!-- 取次店支払額 -->
                            <td>{{ number_format($client['trader_payment_money']) }}円</td>
                            <!-- 利益額 -->
                            <td>{{ number_format($client['profit_money']) }}円</td>
                            <!-- 保険証券データ -->
                            <td><a href="../{{ $client['insurance_policies_image_path'] }}">{{ $client['insurance_policies_image_title'] }}</a></td>
                            <!-- 合意書データ -->
                            <td><a href="../{{ $client['agreements_image_path'] }}">{{ $client['agreements_image_title'] }}</a></td>
                            <!-- 報告書データ -->
                            <td><a href="../{{ $client['reports_image_path'] }}">{{ $client['reports_image_title'] }}</a></td>
                            <!-- 見積書データ -->
                            <td><a href="../{{ $client['quotations_image_path'] }}">{{ $client['quotations_image_title'] }}</a></td>
                            <!-- 認定書データ -->
                            <td><a href="../{{ $client['certifications_image_path'] }}">{{ $client['certifications_image_title'] }}</a></td>
                            <!-- その他データ -->
                            <td><a href="../{{ $client['drawings_image_path'] }}">{{ $client['drawings_image_title'] }}</a></td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $clients->links() }}
    </div>
</div>
@endsection
