@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container" style="flex-flow: column wrap-reverse; margin-bottom: 10px;">

    <div>
        <span style="font-size: 30px;">顧客情報詳細</span>
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
            <ul class="any_method" style="float: right;padding-bottom: 15px;">
                @foreach($authoritys as $authorities)
                    @if($authorities == "削除")
                        <li>
                            <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal1">削除</button>
                        </li>
                    @endif
                @endforeach
                <li><a class="btn btn-info" href="{{ action('ClientController@edit',['id' => $clients['id']]) }}">編集</a></li>
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
                                    <a href="{{ action('ClientController@delete',['id' => $clients['id']]) }}">
                                        <button type="button" class="btn btn-danger">OK</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                {{-- 更新処理後のリダイレクトかどうかの判定 --}}
                @if (session('error_message')||session('success_message')||$errors->any())
                <li><button type="button" class="btn btn-secondary" onclick="history.go(-2)">一覧に戻る</button></li>
                @else
                <li style="margin-right:-5px;"><button type="button" class="btn btn-secondary" onclick="history.back()">一覧に戻る</button></li>
                @endif
            </ul>
        </form>
    </div>

    <!--テーブルカラムにcoment付けてループもありか-->
    <div id="detail_menu">
        <table class="table table-bordered">
            <tr>
                <th>流入フラグ</th>
                <td>{{$clients["advertising"]}}</td>
            </tr>
            <tr>
                <th>依頼日</th>
                <td>{{$clients["request_date"]}}</td>
            </tr>
        
            <tr>
                <th>調査会社</th>
                <td>{{$clients["survey_name"]}}</td>
            </tr>
            
            <tr>
                <th>会員番号</th>
                <td>{{$clients["member"]}}</td>
            </tr>
        
            <tr>
                <th>氏名</th>
                <td>{{$clients["contractor"]}}</td>
            </tr>
            
            <tr>
                <th>住所</th>
                <td>{{$clients["address"]}}</td>
            </tr>
        
            <tr>
                <th>契約者連絡先</th>
                <td>{{$clients["contractor_contact"]}}</td>
            </tr>


            <tr>
                <th>メールアドレス</th>
                <td>{{ $clients['mail_address'] }}</td>
            </tr>

            <tr>
                <th>火災保険加入状況</th>
                <td>
                @if($clients["fire_insurance_flg"] == '0')
                    @php print '未加入'; @endphp
                @elseif($clients["fire_insurance_flg"] == '1')
                    @php print '加入している'; @endphp
                @else
                    @php print ''; @endphp
                @endif
                </td>
            </tr>    
            
            <tr>
                <th>保険会社</th>
                <td>{{$clients["insurance_company"]}}</td>
            </tr>

            <tr>
                <th>築年数</th>
                <td>{{$clients["building_age"]}}</td>
            </tr>
            
            <tr>
                <th>保険会社2</th>
                <td>{{$clients["insurance_company_2"]}}</td>
            </tr>
            <tr>
                <th>保険会社3</th>
                <td>{{$clients["insurance_company_3"]}}</td>
            </tr>
            <tr>
                <th>保険証券タイトル</th>
                <td>{{$clients["insurance_policies_image_title"]}}</td>
            </tr>
            <tr>
                <th>保険証券画像</th>
                <td>
                    <img src="{{url($clients["insurance_policies_image_path"])}}" alt="保険証券画像">
                </td>
            </tr>
            <tr>
                <th>地震 有/無</th>
                <td>
                    @if($clients["earthquake_flg"] == 0)
                        @php print '無' ; @endphp
                    @else
                        @php print '有' ; @endphp
                    @endif
                </td>
            </tr>
            <tr>
                <th>図面タイトル</th>
                <td>{{$clients["drawings_image_title"]}}</td>
            </tr>
            <tr>
                <th>図面画像</th>
                <td>
                    <img src="{{url($clients["drawings_image_path"])}}" alt="図面画像">
                </td>
            </tr>
        
            <tr>
                <th>備考</th>
                <td>{{$clients["note"]}}</td>
            </tr>
            
            <tr>
                <th>現状ST</th>
                <td>{{$clients["status_number"]}}:{{$clients["status_name"]}}</td>
            </tr>

            <tr>
                <th>現調予定日<br>(例:10/01)</th>
                <td>{{$clients["scheduled_survey_date"]}}</td>
            </tr>

            <tr>
                <th>現調日</th>
                <td>{{$clients["survey_date"]}}</td>
            </tr>

            <tr>
                <th>現調担当</th>
                <td>{{$clients["survey_staff"]}}</td>
            </tr>

            <tr>
                <th>合意書<br>(例:10/01)</th>
                <td>{{$clients["agreement_date"]}}</td>
            </tr>

            <tr>
                <th>合意書画像タイトル</th>
                <td>{{$clients["agreements_image_title"]}}</td>
            </tr>

            <tr>
                <th>合意書画像</th>
                <td>
                    <img src="{{url($clients["agreements_image_path"])}}" alt="合意書画像">
                </td>
            </tr>

            <tr>
                <th>事故報告<br>(例:10/01)</th>
                <td>{{$clients["accident_date"]}}</td>
            </tr>

            <tr>
                <th>請求資料到着<br>(例:10/01)</th>
                <td>{{$clients["bill_receipt_date"]}}</td>
            </tr>

            <tr>
                <th>報告書送付<br>(例:10/01)</th>
                <td>{{$clients["report_send_date"]}}</td>
            </tr>

            <tr>
                <th>報告書画像タイトル</th>
                <td>{{$clients["reports_image_title"]}}</td>
            </tr>

            <tr>
                <th>報告書画像</th>
                <td>
                    <img src="{{url($clients["reports_image_path"])}}" alt="報告書画像">
                </td>
            </tr>

            <tr>
                <th>見積書送付<br>(例:10/01)</th>
                <td>{{$clients["quotation_send_date"]}}</td>
            </tr>

            <tr>
                <th>見積額</th>
                <td>¥{{ number_format($clients["quotation_money"]) }}円</td>
            </tr>

            <tr>
                <th>見積画像タイトル</th>
                <td>{{$clients["quotations_image_title"]}}</td>
            </tr>

            <tr>
                <th>見積画像</th>
                <td>
                    <img src="{{url($clients["quotations_image_path"])}}" alt="見積画像">
                </td>
            </tr>

            <tr>
                <th>発送日<br>(例:10/01)</th>
                <td>{{$clients["shipment_date"]}}</td>
            </tr>

            <tr>
                <th>発送先</th>
                <td>{{$clients["shipment_address"]}}</td>
            </tr>

            <tr>
                <th>認定日<br>(例:10/01)</th>
                <td>{{$clients["certification_date"]}}</td>
            </tr>

            <tr>
                <th>認定額</th>
                <td>¥{{ number_format($clients["certification_money"]) }}円</td>
            </tr>

            <tr>
                <th>認定画像タイトル</th>
                <td>{{$clients["certifications_image_title"]}}</td>
            </tr>

            <tr>
                <th>認定画像</th>
                <td>
                    <img src="{{url($clients["certifications_image_path"])}}" alt="認定画像">
                </td>
            </tr>

            <tr>
                <th>清算(請求書発行)</th>
                <td>{{$clients["bill_issue_date"]}}</td>
            </tr>

            <tr>
                <th>請求書画像タイトル</th>
                <td>{{$clients["bill_issues_image_title"]}}</td>
            </tr>

            <tr>
                <th>請求書画像</th>
                <td>
                    <img src="{{url($clients["bill_issues_image_path"])}}" alt="請求書画像">
                </td>
            </tr>

            <tr>
                <th>入金日</th>
                <td>{{$clients["payment_date"]}}</td>
            </tr>
            <tr>
                <th>入金額</th>
                <td>¥{{ number_format($clients["payment_money"]) }}円</td>
            </tr>
            <tr>
                <th>お客様手数料</th>
                <td>{{$clients["clients_fee"]}}%</td>
            </tr>
            <tr>
                <th>工事/コンサル</th>
                <td>{{$clients["construction_consultant"]}}</td>
            </tr>
            <tr>
                <th>クオカード金額</th>
                <td>¥{{ number_format($clients["quo_card_money"]) }}円</td>
            </tr>
            <tr>
                <th>クオカード送付</th>
                <td>{{$clients["quo_card_send"]}}</td>
            </tr>
            <tr>
                <th>営業担当</th>
                <td>{{$clients["sales_staff"]}}</td>
            </tr>
        
        </div>
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
