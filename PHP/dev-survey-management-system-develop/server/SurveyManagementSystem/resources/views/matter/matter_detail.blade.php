@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">法人案件詳細</span>
    </div>

    {{-- 更新失敗時のメッセージを表示 --}}
    @if (session('error_message'))
    <div class="alert alert-danger">
        <ul>
        <!-- 更新失敗メッセージ -->
            <div class="message">
                {{ session('error_message') }}
            </div>
        </ul>
    </div>
    @endif
    {{-- 更新成功時のメッセージを表示 --}}
    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
        <!-- 更新失敗メッセージ -->
            <div class="message">
                {{ session('success_message') }}
            </div>
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
    
    <div>
        @php $authoritys = session()->get('authoritys'); @endphp
        <form method="POST" action="{{ action('MatterController@edit') }}">
            {{ csrf_field() }}
            <ul class="sub_menu any_method">
                @foreach($authoritys as $authorities)
                    @if($authorities == "削除")
                        <li>
                            <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal1">削除</button>
                        </li>
                    @endif
                @endforeach
                <li><a class="btn btn-info" href="{{ action('MatterController@edit',['id' => $matters['id']]) }}">編集</a></li>
                <li>
                    <!-- ↓モーダル表示部分↓ -->
                    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
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
                    </div>
                </li>
                {{-- 更新処理後のリダイレクトかどうかの判定 --}}
                @if (session('error_message')||session('success_message')||$errors->any())
                <li><button type="button" class="btn btn-secondary menu-right" onclick="history.go(-2)">一覧に戻る</button></li>
                @else
                <li><button type="button" class="btn btn-secondary menu-right" onclick="history.back()">一覧に戻る</button></li>
                @endif
            </ul>
        </form>
    </div>

    <!--テーブルカラムにcoment付けてループもありか-->
    <div id="detail_menu">
        <table class="table table-bordered">
            <tr>
                <th>調査会社</th>
                <td>{{ $matters->survey_name }}</td>
            </tr>
            <tr>
                <th>ID</th>
                <td>{{ $matters->member }}</td>
            </tr>
            {{--<tr>
                <th>グループ</th>
                <td>{{ $matters->gloup_name }}</td>
            </tr>--}}
            <tr>
                <th>会社名</th>
                <td>{{ $matters->contractor }}</td>
            </tr>
            <tr>
                <th>建物(名称)</th>
                <td>{{ $matters->property_information }}</td>
            </tr>
            <tr>
                <th>保険契約者名</th>
                <td>{{ $matters->insurance_policyholder }}</td>
            </tr>
            <tr>
                <th>施設名</th>
                <td>{{ $matters->buildingname }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $matters->address }}</td>
            </tr>
            <tr>
                <th>連絡方法</th>
                <td>{{ $matters->contact_method }}</td>
            </tr>
            <tr>
                <th>取次店</th>
                <td>{{ $matters->introducer }}</td>
            </tr>
            <tr>
                <th>保険会社</th>
                <td>{{ $matters->insurance_company }}</td>
            </tr>
            <tr>
                <th>保険会社</th>
                <td>{{ $matters->insurance_company_2 }}</td>
            </tr>
            <tr>
                <th>保険会社</th>
                <td>{{ $matters->insurance_company_3 }}</td>
            </tr>
            <tr>
                <th>進捗状況</th>
                <td>{{ $matters->status_name }}</td>
            </tr>
            <tr>
                <th>備考</th>
                <td>{{ $matters->note }}</td>
            </tr>
            <tr>
                <th>図面</th>
                @if($matters->drawing  == 0)
                    <td>-</td>
                @else
                    <td>〇</td>
                @endif
            </tr>
            <tr>
                <th>図面画像タイトル</th>
                <td>{{ $matters->drawings_image_path }}</td>
            </tr>
            <tr>
                <th>図面画像</th>
                <td>
                    <img src="{{ url($matters->drawings_image_title) }}" alt="" style="max-width: 450px; max-height: 450px;">
                </td>
            </tr>
            <tr>
                <th>合意書</th>
                @if($matters->agreement == 0)
                    <td>-</td>
                @else
                    <td>〇</td>
                @endif
            </tr>
            <tr>
                <th>合意書画像タイトル</th>
                <td>{{ $matters->agreements_image_title }}</td>
            </tr>
            <tr>
                <th>合意書画像</th>
                <td>
                    <img src="{{ url($matters->agreements_image_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                </td>
            </tr>
            <tr>
                <th>保険証券</th>
                @if($matters->insurance_policy == 0)
                    <td>-</td>
                @else
                    <td>〇</td>
                @endif
            </tr>
            <tr>
                <th>保険証券画像タイトル</th>
                <td>{{ $matters->insurance_policies_image_title }}</td>
            </tr>
            <tr>
                <th>保険証券画像</th>
                <td>
                    <img src="{{ url($matters->insurance_policies_image_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                </td>
            </tr>
            <tr>
                <th>事前打ち合わせ</th>
                <td>{{ $matters->meeting_date }}</td>
            </tr>
            <tr>
                <th>現調日予定日<br>（例:10/01）</th>
                <td>{{ $matters->scheduled_survey_date }}</td>
            </tr>
            <tr>
                <th>現調日<br>（例:10/01）</th>
                <td>{{ $matters->survey_date }}</td>
            </tr>
            <tr>
                <th>現調担当</th>
                <td>{{ $matters->survey_staff }}</td>
            </tr>
            <tr>
                <th>事故報告<br>（例:10/01）</th>
                <td>{{ $matters->accident_date }}</td>
            </tr>
            <tr>
                <th>請求用紙到着（民間）<br>（例:10/01）</th>
                <td>{{ $matters->billing_receipt_date }}</td>
            </tr>
            <tr>
                <th>報告書完成日<br>（例:10/01）</th>
                <td>{{ $matters->report_completed_date }}</td>
            </tr>
            <tr>
                <th>報告書画像タイトル</th>
                <td>{{ $matters->reports_image_title }}</td>
            </tr>
            <tr>
                <th>報告書画像</th>
                <td>
                    <img src="{{ url($matters->reports_image_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                </td>
            </tr>
            <tr>
                <th>見積書完成日<br>（例:10/01）</th>
                <td>{{ $matters->quotation_completed_date }}</td>
            </tr>
            <tr>
                <th>見積額</th>
                <td>¥{{ number_format($matters->quotation_money) }}</td>
            </tr>
            <tr>
                <th>見積書画像タイトル</th>
                <td>{{ $matters->quotations_image_title }}</td>
            </tr>
            <tr>
                <th>見積書画像</th>
                <td>
                    <img src="{{ url($matters->quotations_image_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                </td>
            </tr>
            <tr>
                <th>発送日<br>（例:10/01）	</th>
                <td>{{ $matters->submit_sending_date }}</td>
            </tr>
            <tr>
                <th>発送先(保険会社/お客様)</th>
                <td>{{ $matters->document_submit_to }}</td>
            </tr>
            <tr>
                <th>鑑定日</th>
                <td>{{ $matters->judge_date }}</td>
            </tr>
            <tr>
                <th>認定日<br>（例:10/01）</th>
                <td>{{ $matters->certification_date }}</td>
            </tr>
            <tr>
                <th>認定額</th>
                <td>¥{{ number_format($matters->certification_money) }}</td>
            </tr>
            <tr>
                <th>認定書画像タイトル</th>
                <td>{{ $matters->certifications_image_title }}</td>
            </tr>
            <tr>
                <th>認定書画像</th>
                <td>
                    <img src="{{ url($matters->certifications_image_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                </td>
            </tr>
            <tr>
                <th>顧客請求書送付<br>(例:10/01)</th>
                <td>{{ $matters->customer_invoice_date }}</td>
            </tr>
            <tr>
                <th>請求書画像タイトル</th>
                <td>{{ $matters->bill_issues_image_title }}</td>
            </tr>
            <tr>
                <th>請求書画像</th>
                <td>
                    <img src="{{ url($matters->bill_issues_image_path) }}" alt="" style="max-width: 450px; max-height: 450px;">
                </td>
            </tr>
            <tr>
                <th>入金日<br>（例:10/01）</th>
                <td>{{ $matters->payment_date }}</td>
            </tr>
            <tr>
                <th>入金額</th>
                <td>¥{{ number_format($matters->payment_money) }}</td>
            </tr>
            <tr>
                <th>お客様手数料</th>
                <td>{{ $matters->fee }}%</td>
            </tr>
            <tr>
                <th>取次店</th>
                <td>{{ $matters->trader_name }}</td>
            </tr>
            <tr>
                <th>紹介率</th>
                <td>{{ $matters->referral_rate }}%</td>
            </tr>
            <tr>
                <th>紹介率合計</th>
                <td>{{ $matters->referral_rate_total }}%</td>
            </tr>
            <tr>
                <th>取次店2</th>
                <td>
                    @foreach($traders as $trader)
                        @if($matters->agency_store_2 == $trader->id)
                            @php print $trader->trader_name @endphp
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>紹介率</th>
                <td>{{ $matters->referral_rate_2 }}%</td>
            </tr>
            <tr>
                <th>取次店3</th>
                <td>
                    @foreach($traders as $trader)
                        @if($matters->agency_store_3 == $trader->id)
                            @php print $trader->trader_name @endphp
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>紹介率</th>
                <td>{{ $matters->referral_rate_3 }}%</td>
            </tr>
            <tr>
                <th>調査会社手数料</th>
                <td>{{ $matters->survey_referral }}</td>
            </tr>
            <tr>
                <th>リグラント手数料</th>
                <td>{{ number_format($matters->riguranto_fee) }}%</td>
            </tr>
            <tr>
                <th>工事コンサル</th>
                <td>{{ $matters->construction_consultant }}</td>
            </tr>
            <tr>
                <th>営業担当</th>
                <td>{{ $matters->sales_staff }}</td>
            </tr>
            <tr>
                <th>登録者</th>
                <td>{{ $matters->username }}</td>
            </tr>

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
@endsection