@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">業者情報詳細</span>
    </div>

    @php $authoritys = session()->get('authoritys'); @endphp
    <div class="text-right mb-2">
        <ul class="sub_menu any_method">
            @foreach($authoritys as $authorities)
                @if($authorities == "削除")
                    <li>
                        <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal1">削除</button>
                    </li>
                @endif
            @endforeach
            <li><button onclick="location.href='{{ action('TraderController@edit', ['id' => $traders->id]) }}'" class="btn btn-info">編集</button></li>
            <li><button onclick="location.href='{{ action('TraderController@reward') }}'" class="btn btn-secondary">報酬・詳細一覧へ</button></li>
            <li style="margin-right: -15px;"><button onclick="location.href='{{ action('TraderController@all') }}'" class="btn btn-secondary">一覧に戻る</button></li>

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
                                <a href="{{ action('TraderController@delete',['id' => $traders['id']]) }}">
                                    <button type="button" class="btn btn-danger">OK</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div id="detail_menu">
        <table class="table table-bordered">
            <tr>
                <th>案件入金額</th>
                <td>
                    @if($client_payment_money != '')
                        {{ number_format($client_payment_money) }}円
                    @elseif($matter_payment_money_1 != '')
                        {{ number_format($matter_payment_money_1) }}円
                    @elseif($matter_payment_money_2 != '')
                        {{ number_format($matter_payment_money_2) }}円
                    @elseif($matter_payment_money_3 != '')
                        {{ number_format($matter_payment_money_3) }}円
                    @endif
                </td>
            </tr>
            <tr>
                <th>翌月の入金額</th>
                <td>{{ $payment_month }}月請求：{{ number_format($payment_money) }}円</td>
            </tr>
            <tr>
                <th>番号</th>
                <td>{{ $traders["id"] }}</td>
            </tr>
            <tr>
                <th>紹介者</th>
                <td>{{ $traders["introducer"] }}</td>
            </tr>
            <tr>
                <th>VIP</th>
                <td>
                    @if($traders["vip"] == 0)
                        @php print '-'; @endphp
                    @else
                        @php print '〇'; @endphp
                    @endif
                </td>
            </tr>
            <tr>
                <th>取次店</th>
                <td>{{ $traders["trader_name"] }}</td>
            </tr>
            <tr>
                <th>法人・個人</th>
                <td>
                    @if($traders["business_form"] == 0)
                        @php print '法人'; @endphp
                    @else
                        @php print '個人'; @endphp
                    @endif
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td><a href="mailto:{{$traders['trader_email']}}">{{$traders["trader_email"]}}</a></td>
            </tr>
            <tr>
                <th>所属企業</th>
                <td>{{$traders["affiliated_company"]}}</td>
            </tr>
            <tr>
                <th>役職</th>
                <td>{{$traders["position"]}}</td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td>{{$traders["trader_zipcode"]}}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{$traders["trader_address"]}}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{$traders["trader_phone"]}}</td>
            </tr>
            <tr>
                <th>電話番号2</th>
                <td>{{$traders["trader_phone_2"]}}</td>
            </tr>
            <tr>
                <th>金融機関</th>
                <td>{{ $traders['financial_institution'] }}</td>
            </tr>
            <tr>
                <th>支店名</th>
                <td>{{ $traders['financial_branch'] }}</td>
            </tr>
            <tr>
                <th>口座種類</th>
                <td>
                    @if($traders['bank_acount_kinds'] == 0)
                        @php print '普通'; @endphp
                    @else
                        @php print '当座'; @endphp
                    @endif
                </td>
            </tr>
            <tr>
                <th>口座番号</th>
                <td>{{ $traders['bank_acount_number'] }}</td>
            </tr>
            <tr>
                <th>口座名義</th>
                <td>{{ $traders['bank_acount_name'] }}</td>
            </tr>
            <tr>
                <th>契約書送付日</th>
                <td>{{$traders["contract_sending_date"]}}</td>
            </tr>
            <tr>
                <th>契約書締結日</th>
                <td>{{$traders["contract_conclusion_date"]}}</td>
            </tr>
            <tr>
                <th>秘密保持契約書データ送付日</th>
                <td>{{ $traders['secret_contract_date'] }}</td>
            </tr>
            <tr>
                <th>主な案件</th>
                <td>{{$traders["main_project"]}}</td>
            </tr>
            <tr>
                <th>備考</th>
                <td>{{$traders["trader_note"]}}</td>
            </tr>
            <!--<tr>
                <th>Webサイト</th>
                <td><a href="{{$traders['trader_url']}}">{{$traders["trader_url"]}}</a></td>
            </tr>-->
        </table>
    </div>
</div>
@endsection