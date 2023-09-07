@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet">
    <script src="{{ asset('js/client_search.js') }}"></script>

<div class="container">
    <div>
        <span style="font-size: 30px;">取次店編集</span>
    </div>

    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('success_message') }}</li>
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
            <button onclick="location.href='{{ action('TraderController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
        </div>
    </div>

    <div id="detail_menu">
        <form action="{{ action('TraderController@edit_check') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @php $authoritys = session()->get('authoritys'); @endphp

            <table class="table table-bordered">

                <input type="hidden" name="id" value="{{ $traders['id'] }}">

                <tr>
                    <th>紹介者</th>
                    <td>
                        <select name="introducer" class="form-control">
                            @if($traders['introducer'] == '0' || !(array_key_exists($traders['introducer'], $introducer_name))){
                                <option value="0" selected>紹介者無し</option>
                            }
                            @else{
                                <option value="{{ $traders['introducer'] }}" selected>{{ $introducer_name[$traders['introducer']] }}</option>
                                <option value="{{ $traders['introducer'] }}">紹介者無し</option>
                            }
                            @endif
                            @foreach ($introducers as $val)
                                <option value="{{ $val['id'] }}">{{ $val['id'] }}{{ $val['trader_name'] }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @foreach($authoritys as $authorities)
                    @if($authorities == "全画面")
                        <tr>
                            <th>VIP</th>
                            <td>
                                <select name="vip" class="form-control">
                                    @if($traders['vip'] == 0) 
                                        <option value=0 selected>-</option>
                                        <option value=1>〇</option>
                                    @else
                                        <option value=0>-</option>
                                        <option value=1 selected>〇</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th>取次店<font color="red">＊</font></th>
                    <td><input type="text" class="form-control" name="trader_name" value="{{ $traders['trader_name'] }}" required></td>
                </tr>
                @foreach($authoritys as $authorities)
                    @if($authorities == "全画面")
                        <tr>
                            <th>法人・個人</th>
                            <td>
                                <select name="business_form" class="form-control">
                                    @if($traders['business_form'] == 0) 
                                        <option value=0 selected>法人</option>
                                        <option value=1>個人</option>
                                    @else
                                        <option value=0>法人</option>
                                        <option value=1 selected>個人</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス<font color="red">＊</font></th>
                            <td><input type="email" class="form-control" name="trader_email" value="{{ $traders['trader_email'] }}" maxlength="100" required></td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <th>所属企業<font color="red">＊</font></th>
                    <td><input type="text" class="form-control" name="affiliated_company" value="{{ $traders['affiliated_company'] }}" required></td>
                </tr>
                <tr>
                    <th>役職</th>
                    <td><input type="text" class="form-control" name="position" value="{{ $traders['position'] }}"></td>
                </tr>
                @foreach($authoritys as $authorities)
                    @if($authorities == "全画面")
                        <tr>
                            <th>郵便番号<font color="red">＊</font></th>
                            <td><input type="text" class="form-control" name="trader_zipcode" value="{{ $traders['trader_zipcode'] }}" maxlength="7" placeholder="半角数字のみ入力して下さい" required></td>
                        </tr>
                        <tr>
                            <th>住所<font color="red">＊</font></th>
                            <td><input type="text" class="form-control" name="trader_address" value="{{ $traders['trader_address'] }}" placeholder="番地・建物名まで入力して下さい" required></td>
                        </tr>
                        <tr>
                            <th>電話番号<font color="red">＊</font></th>
                            <td><input type="text" class="form-control" name="trader_phone" value="{{ $traders['trader_phone'] }}" maxlength="13" placeholder="半角数字のみ入力して下さい" required></td>
                        </tr>
                        <tr>
                            <th>電話番号2</th>
                            <td><input type="text" class="form-control" name="trader_phone_2" value="{{ $traders['trader_phone_2'] }}" maxlength="13" placeholder="半角数字のみ入力して下さい"></td>
                        </tr>
                        <tr>
                        <th>金融機関</th>
                            <td><input type="text" class="form-control" value="{{ $traders['financial_institution'] }}" name="financial_institution"></td>
                        </tr>
                        <tr>
                            <th>支店名</th>
                            <td><input type="text" class="form-control" value="{{ $traders['financial_branch'] }}" name="financial_branch"></td>
                        </tr>
                        <tr>
                            <th>口座種類</th>
                            <td>
                                <select name="bank_acount_kinds" class="form-control">
                                    @if($traders['bank_acount_kinds'] == 0) 
                                        <option value=0 selected>普通</option>
                                        <option value=1>当座</option>
                                    @else
                                        <option value=0>普通</option>
                                        <option value=1 selected>当座</option>
                                    @endif
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>口座番号</th>
                            <td><input type="text" class="form-control" value="{{ $traders['bank_acount_number'] }}" name="bank_acount_number"></td>
                        </tr>
                        <tr>
                            <th>口座名義</th>
                            <td><input type="text" class="form-control" value="{{ $traders['bank_acount_name'] }}" name="bank_acount_name"></td>
                        </tr>
                        <tr>
                            <th>契約書送付日</th>
                            <td><input type="date" class="form-control" name="contract_sending_date" value="{{ $traders['contract_sending_date'] }}"></td>
                        </tr>
                        <tr>
                            <th>契約書締結日</th>
                            <td><input type="date" class="form-control" name="contract_conclusion_date" value="{{ $traders['contract_conclusion_date'] }}"></td>
                        </tr>
                        <tr>
                            <th>秘密保持契約書データ送付日</th>
                            <td><input type="date" class="form-control" name="secret_contract_date" value="{{ $traders['secret_contract_date'] }}"></td>
                        </tr>
                        <tr>
                            <th>主な要件</th>
                            <td><input type="text" class="form-control" name="main_project" value="{{ $traders['main_project'] }}"></td>
                        </tr>
                        <tr>
                            <th>備考</th>
                            <td><input type="text" class="form-control" name="trader_note" value="{{ $traders['trader_note'] }}" maxlength="255"></td>
                        </tr>
                        <tr>
                            <th>契約書データ</th>
                            <td>
                                <button type="button" class="btn btn-outline-dark"  data-toggle="modal" data-target="#contract_conclusion_modal" style="background-color:silver#c0c0c0;">契約書データ</button>
                            </td>
                            <!-- ↓モーダル表示部分↓ -->
                            <div class="modal fade" id="contract_conclusion_modal" tabindex="-1" role="dialog" aria-labelledby="image_path" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="image_path">契約データの変更</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>タイトル</label>
                                                <input type="text" class="form-control" name="image_title" value="{{ $trader_contract_conclusion['image_title'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label>データのインポート</label><br>
                                                <b><font color="red">ファイル形式:jpeg,png,jpg,bmb,pdfのみ ファイルサイズ:2MBまで</font></b>
                                                <input type="file" class="form-control-file" name="image_path" id="image_preview">
                                            </div>
                                            <img id="preview" style="max-width: 450px; max-height: 450px;">
                                            <div class="form-group">
                                                <label>現在のデータ</label>
                                                <img src="{{$trader_contract_conclusion['image_path']}}" alt="書類" style="max-width: 450px; max-height: 450px;"></td>
                                                <input type="hidden" class="form-control" value="{{ $trader_contract_conclusion['image_path'] }}" name="before_image_path">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">編集画面へ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endif
                @endforeach
            </table>
            <div class="text-right">
                <input type="submit" value="内容確認" class="btn btn-info">
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