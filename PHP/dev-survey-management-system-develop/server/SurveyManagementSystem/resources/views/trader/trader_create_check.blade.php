@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">取次店登録確認</span>
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

    <div class="enter_check_top">
        <div id="enter_check">以下の内容で修正します</div>
        <div><a class="btn btn-secondary" onclick="history.back()">入力フォーム戻る</a></div>
    </div>

    <form action="{{ action('TraderController@add') }}" method="POST">
        {{ csrf_field() }}
        <div id="detail_menu">
            <table class="table table-bordered">
                <tr>
                    <th>紹介者</th>
                    <td class="table-light">{{ $introducer_name['trader_name'] }}</td>
                    <input type="hidden" value="{{ $traders['introducer'] }}" name="introducer">
                </tr>
                <tr>
                    <th>VIP</th>
                    <td class="table-light">
                        @if($traders['vip'] == 0)
                            @php print '-'; @endphp
                        @else
                            @php print '〇'; @endphp
                        @endif
                    </td>
                    <input type="hidden" value="{{ $traders['vip'] }}" name="vip_flg">
                </tr>
                <tr>
                    <th>取次店</th>
                    <td class="table-light">{{ $traders['trader_name'] }}</td>
                    <input type="hidden" value="{{ $traders['trader_name'] }}" name="trader_name">
                </tr>
                <tr>
                    <th>法人・個人</th>
                    <td class="table-light">
                        @if($traders['business_form'] == 0)
                            @php print '法人'; @endphp
                        @else
                            @php print '個人'; @endphp
                        @endif
                    </td>
                    <input type="hidden" value="{{ $traders['business_form'] }}" name="business_form">
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td class="table-light">{{ $traders['trader_email'] }}</td>
                    <input type="hidden" value="{{ $traders['trader_email'] }}" name="trader_email">
                </tr>
                <tr>
                    <th>所属企業</th>
                    <td class="table-light">{{ $traders['affiliated_company'] }}</td>
                    <input type="hidden" value="{{ $traders['affiliated_company'] }}" name="affiliated_company">
                </tr>
                <tr>
                    <th>役職</th>
                    <td class="table-light">{{ $traders['position'] }}</td>
                    <input type="hidden" value="{{ $traders['position'] }}" name="position">
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td class="table-light">{{ substr($traders['trader_zipcode'],0,3) . "-" . substr($traders['trader_zipcode'],3) }}</td>
                    <input type="hidden" value="{{ $traders['trader_zipcode'] }}" name="trader_zipcode">
                </tr>
                <tr>
                    <th>住所</th>
                    <td class="table-light">{{ $traders['trader_address'] }}</td>
                    <input type="hidden" value="{{ $traders['trader_address'] }}" name="trader_address">
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td class="table-light">{{ $trader_phone }}</td>
                    <input type="hidden" value="{{ $traders['trader_phone'] }}" name="trader_phone">
                </tr>
                <tr>
                    <th>電話番号2</th>
                    <td class="table-light">{{ $trader_phone_2 }}</td>
                    <input type="hidden" value="{{ $traders['trader_phone_2'] }}" name="trader_phone_2">
                </tr>
                <tr>
                    <th>金融機関</th>
                    <td class="table-light">{{ $traders['financial_institution'] }}</td>
                    <input type="hidden" value="{{ $traders['financial_institution'] }}" name="financial_institution">
                </tr>
                <tr>
                    <th>支店名</th>
                    <td class="table-light">{{ $traders['financial_branch'] }}</td>
                    <input type="hidden" value="{{ $traders['financial_branch'] }}" name="financial_branch">
                </tr>
                <tr>
                    <th>口座種類</th>
                    <td class="table-light">
                        @if($traders['bank_acount_kinds'] == 0)
                            @php print '普通'; @endphp
                        @else
                            @php print '当座'; @endphp
                        @endif
                    </td>
                    <input type="hidden" value="{{ $traders['bank_acount_kinds'] }}" name="bank_acount_kinds">
                </tr>
                <tr>
                    <th>口座番号</th>
                    <td class="table-light">{{ $traders['bank_acount_number'] }}</td>
                    <input type="hidden" value="{{ $traders['bank_acount_number'] }}" name="bank_acount_number">
                </tr>
                <tr>
                    <th>口座名義</th>
                    <td class="table-light">{{ $traders['bank_acount_name'] }}</td>
                    <input type="hidden" value="{{ $traders['bank_acount_name'] }}" name="bank_acount_name">
                </tr>
                <tr>
                    <th>契約書送付日</th>
                    <td class="table-light">{{ $traders['contract_sending_date'] }}</td>
                    <input type="hidden" value="{{ $traders['contract_sending_date'] }}" name="contract_sending_date">
                </tr>
                <tr>
                    <th>契約書締結日</th>
                    <td class="table-light">{{ $traders['contract_conclusion_date'] }}</td>
                    <input type="hidden" value="{{ $traders['contract_conclusion_date'] }}" name="contract_conclusion_date">
                </tr>
                <tr>
                    <th>秘密保持契約書データ送付日</th>
                    <td class="table-light">{{ $traders['secret_contract_date'] }}</td>
                    <input type="hidden" value="{{ $traders['secret_contract_date'] }}" name="secret_contract_date">
                </tr>
                <tr>
                    <th>主な案件</th>
                    <td class="table-light">{{ $traders['main_project'] }}</td>
                    <input type="hidden" value="{{ $traders['main_project'] }}" name="main_project">
                </tr>
                <tr>
                    <th>備考</th>
                    <td class="table-light">{{ $traders['trader_note'] }}</td>
                    <input type="hidden" value="{{ $traders['trader_note'] }}" name="trader_note">
                </tr>

                <input type="hidden" value=1 name="trader_contract_conclusion_id">
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
        <div class="text-right">
            <button type="button" class="btn btn-secondary" onclick="history.back()">入力フォームへ戻る</button>
            <input type="submit" value="登録" class="btn btn-info">
        </div>
    </form>
</div>
@endsection