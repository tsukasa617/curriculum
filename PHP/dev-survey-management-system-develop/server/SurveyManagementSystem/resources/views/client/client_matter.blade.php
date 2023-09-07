@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">該当案件一覧</span>
</div>
<script src="{{ asset('js/checkbox.js') }}"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="container-fluid">
    <div>
        <ul class="matter_all_sub">
            <div class="matter_all_search">
                <form action="{{ action('MatterController@filter_search') }}" method="POST">
                    {{ csrf_field() }}
                    {{--<li class="list">
                        <input type="text" class="form-control" name="search" placeholder="キーワード検索">
                    </li>--}}
                    <li>
                        <input type='button' class="btn btn-primary" value='更新' id='get_value' style="display: none">
                    </li>
                </form>
            </div>
        </ul>
    </div>

    <div class="table_position">
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th style="width: 2em"><input type="checkbox" name="allchecked" id="all"></th>
                    <th class="detail_space"></th>
                    <th>ステータス</th>
                    <th>申請状況</th>
                    <th>業者</th>
                    <th>調査会社</th>
                    {{-- <th>HSA担当者</th> --}}
                    <th>会員番号</th>
                    <th>契約者</th>
                    <th>対応者</th>
                    <th>契約者連絡先</th>
                    <th>対応者連絡先</th>
                    <th>その他連絡先</th>
                    <th>メールアドレス</th>
                    <th>郵便番号</th>
                    <th>都道府県</th>
                    <th>市区町村</th>
                    <th>町域</th>
                    <th>建物名・部屋番号</th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach ($matters as $matter)
                <tr>
                    <td class="check"><input type="checkbox" name="chk[]" value="{{ $matter->id }}" class="is"></td>
                    <td><button onclick="location.href='{{ action('MatterController@detail',['id'=>$matter->id]) }}'" class="btn-sm btn-info">詳細</button></td>
                    <td>{{ $matter->status_name }}</td> <!-- ステータス -->
                    <td>{{ $matter->application_status }}</td> <!-- 申請状況 -->

                    {{-- <td>{{ $matter->trader_name }}</td> <!-- 所属 --> --}}
                    <td>
                        <span>{{ $matter->trader_name }}</span>
                        <i class="material-icons" style="cursor: pointer">create</i>
                        {{-- ボタンを押したら切り替え --}}
                        <select name="insurance_account_payable" class="form-control belong" name="sta[]" style="width: auto;display: none;">
                            <option value="{{ $matter->trader }}" selected>{{ $matter->trader_name }}</option>
                            @foreach ($trader_name as $val)
                            <option value="{{ $val['id'] }}" )>{{ $val['trader_name'] }}</option>
                            @endforeach
                        </select>
                    </td>

                    {{-- <td>{{ $matter->pic }}</td> <!-- 担当者 --> --}}
                    <td>
                        <span>{{ $matter->corp_name }}</span>
                        <i class="material-icons" style="cursor: pointer">create</i>
                        {{-- ボタンを押したら切り替え --}}
                        <select name="insurance_account_payable" class="form-control pic" name="sta[]" style="width: auto;display: none;">
                            <option value="{{ $matter->survey }}" selected>{{ $matter->corp_name }}</option>
                            @foreach ($corp_name as $val)
                            <option value="{{ $val['id'] }}" )>{{ $val['corp_name'] }}</option>
                            @endforeach
                        </select>
                    </td>

                    {{-- <td>{{ $matter->hsa_pic }}</td> --}}
                    <!-- HSA担当者 -->
                    <td></td> <!-- 会員番号 -->
                    <td>{{ $matter->contractor }}</td> <!-- 契約者 -->
                    <td>{{ $matter->responder }}</td> <!-- 対応者 -->
                    <td>{{ $matter->contractor_contact }}</td> <!-- 契約者連絡先 -->
                    <td>{{ $matter->responder_contact }}</td> <!-- 対応者連絡先 -->
                    <td>{{ $matter->other_contact }}</td> <!-- その他連絡先 -->
                    <td>{{ $matter->email }}</td> <!-- メールアドレス -->
                    <td>{{ $matter->zipcode }}</td> <!-- 郵便番号 -->
                    <td>{{ $matter->prefectures }}</td> <!-- 都道府県 -->
                    <td>{{ $matter->city }}</td> <!-- 市区町村 -->
                    <td>{{ $matter->town_area }}</td> <!-- 町域 -->
                    <td>{{ $matter->buildingname_roomnumber }}</td> <!-- 建物名・部屋番号 -->
                    @if ($matter->status_name == '保留')
                    <td><a href="{{ action('MatterController@invoiceDownload', ['id'=>$matter->id]) }}" class="btn-sm btn-info">請求書発行</a></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @if (!$matters->isEmpty())
        {{ $matters->links() }}
        @endif
    </div>
</div>
@endsection
