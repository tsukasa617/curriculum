@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<script src="{{ asset('js/checkbox_trader.js') }}"></script>
<div class="container">
    <div>
        <span style="font-size: 30px;">法人案件取次店一覧</span>
    </div>
    
    {{--権限の取得--}}
    @php $authoritys = session()->get('authoritys'); @endphp
    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('success_message') }}</li>
        </ul>
    </div>
    @elseif (session('error_message'))
    <div class="alert alert-done">
        <ul>
            <li>{{ session('error_message') }}</li>
        </ul>
    </div>
    @endif
    <div>

    </div>
    <div>
        <ul class="matter_all_sub">
            <div class="matter_all_search">
                <form action="{{ action('TraderController@filter_search') }}" method="POST">
                    {{ csrf_field() }}
                    <li class="list">
                        <input type="text" class="form-control" name="search" placeholder="キーワード検索" style="margin-left: -5px;">
                    </li>
                    <li>
                        <input type='submit' class="btn btn-primary" value='検索'>
                    </li>
                </form>
                @foreach($authoritys as $authorities)
                    @if($authorities == "削除")
                        <li>
                            <input type='button' class="btn btn-danger" value='削除' id='forget_value' style="display: none">
                        </li>
                    @endif
                @endforeach
            </div>
            <div style="margin-right:10px;">
                <button class="btn btn-outline-secondary"><a href="{{ action('TraderController@create') }}">新規登録</a></button>
            </div>
            @foreach($authoritys as $authorities)
                @if($authorities == "ユーザー周り")
                    <div>
                        <button class="btn btn-outline-secondary"><a href="{{ action('TraderController@export_csv') }}">CSV出力</a></button>
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
                    @foreach($authoritys as $authorities)
                        @if($authorities == "削除")
                            <th class="detail_space"></th>
                        @endif
                    @endforeach
                    @foreach($authoritys as $authorities)
                        @if($authorities == "編集")
                            <th class="edit_space"></th>
                        @endif
                    @endforeach
                    @foreach($authoritys as $authorities)
                        @if($authorities == "調査会社")
                            <th>No</th>
                            <th>紹介者</th>
                            <th>取次店</th>
                            <th>所属企業</th>
                            <th>役職</th>
                        @endif
                    @endforeach
                    @foreach($authoritys as $authorities)
                        @if($authorities == "全画面")
                            <th>No</th>
                            <th>紹介者</th>
                            <th>VIP</th>
                            <th>取次店</th>
                            <th>法人・個人</th>
                            <th>メールアドレス</th>
                            <th>所属企業</th>
                            <th>役職</th>
                            <th>郵便番号</th>
                            <th>住所</th>
                            <th>電話番号</th>
                            <th>電話番号２</th>
                            <th>金融機関</th>
                            <th>支店名</th>
                            <th>口座種類</th>
                            <th>口座番号</th>
                            <th>口座名義</th>
                            <th>契約書締結日</th>
                            <th>契約書送付日</th>
                            <th>秘密保持契約書データ送付日</th>
                            <th>契約書データ</th>
                            <th>主な案件</th>
                            <th>備考</th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody class="table">
                @foreach($traders as $trader)
                    <tr>
                        <td class="check"><input type="checkbox" name="chk[]" value="{{ $trader->id }}" class="is"></td>
                        @foreach($authoritys as $authorities)
                            @if($authorities == "削除")
                                <td><button onclick="location.href='{{ action('TraderController@detail', ['id' => $trader->id]) }}'" class="btn-sm btn-success">詳細</button></td>
                            @endif
                        @endforeach
                        @foreach($authoritys as $authorities)
                            @if($authorities == "編集")
                                <td><button onclick="location.href='{{ action('TraderController@edit', ['id' => $trader->id]) }}'" class="btn-sm btn-info">編集</button></td>
                            @endif
                        @endforeach
                        @foreach($authoritys as $authorities)
                            @if($authorities == "調査会社")
                                <td>{{ $trader->id }}</td>
                                @if($trader->introducer == '0' || !(array_key_exists($trader->introducer, $introducer_name)))
                                    <td>紹介者無し</td>
                                @else 
                                    <td>{{ $introducer_name[$trader->introducer] }}</td>
                                @endif
                                <td>{{ $trader->trader_name }}</td>
                                <td>{{ $trader->affiliated_company }}</td>
                                <td>{{ $trader->position }}</td>
                            @endif
                        @endforeach
                        @foreach($authoritys as $authorities)
                            @if($authorities == "全画面")
                                <td>{{ $trader->id }}</td>
                                @if($trader->introducer == '0' || !(array_key_exists($trader->introducer, $introducer_name)))
                                    <td>紹介者無し</td>
                                @else 
                                    <td>{{ $introducer_name[$trader->introducer] }}</td>
                                @endif
                                <td>
                                    @if($trader->vip == '0')
                                        @php print '-'; @endphp
                                    @else
                                        @php print '〇'; @endphp
                                    @endif
                                </td>
                                <td>{{ $trader->trader_name }}</td>
                                <td>
                                    @if($trader->business_form == '0')
                                        @php print '法人'; @endphp
                                    @else
                                        @php print '個人'; @endphp
                                    @endif
                                </td>
                                <td>{{ $trader->trader_email }}</td>
                                <td>{{ $trader->affiliated_company }}</td>
                                <td>{{ $trader->position }}</td>
                                <td>{{ substr_replace($trader->trader_zipcode, '-', 3, 0) }}</td>
                                <td>{{ $trader->trader_address }}</td>
                                <td>{{ $trader->trader_phone }}</td>
                                <td>{{ $trader->trader_phone_2 }}</td>
                                <td>{{ $trader->financial_institution }}</td>
                                <td>{{ $trader->financial_branch }}</td>
                                <td>
                                    @if($trader->bank_acount_kinds == '0')
                                        @php print '普通'; @endphp
                                    @else
                                        @php print '当座'; @endphp
                                    @endif
                                </td>
                                <td>{{ $trader->bank_acount_number }}</td>
                                <td>{{ $trader->bank_acount_name }}</td>
                                <td>{{ substr($trader->contract_sending_date, 5) }}</td>
                                <td>{{ substr($trader->contract_conclusion_date, 5) }}</td>
                                <td>{{ substr($trader->secret_contract_date, 5) }}</td>
                                <td><a href="../{{ $trader->image_path }}">{{ $trader->image_title }}</a></td>
                                <td>{{ $trader->main_project }}</td>
                                <td>{{ $trader->trader_note }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
