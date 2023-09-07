@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span class="search-result-title">顧客検索結果</span>
    <span class="search-result-count">該当件数：{{ count($clients) }}件</span>
</div>
<div class="d-flex justify-content-between">
    <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="margin-bottom: 5px; margin-left:30px;">再検索</button>
    <button onclick="location.href='{{ action('SearchController@index') }}'" class="btn btn-info pull-right search-index-button"  style="margin-bottom: 5px; margin-right:30px;">検索トップに戻る</button>
</div>
<div class="container float-left" style="margin-bottom: 5px;">
        <div class="collapse" id="collapseExample">
        <form action="{{ action('SearchController@client_result') }}" method="POST">
        {{ csrf_field() }}
            <div class="jumbotron" style="padding:10px 20px; margin-left:15px;">
                <div class="form-group row">
                    <select name="searchs[0][select_column]" class="form-control col-sm-3">
                        <option value="trader">業者</option>
                        <option value="survey">調査会社</option>
                        <option value="member_id">会員番号</option>
                        <option value="contractor">契約者</option>
                        <option value="contractor_kana">契約者フリガナ</option>
                        <option value="contractor_contact">契約者連絡先</option>
                        <option value="responder">対応者</option>
                        <option value="responder_kana">対応者フリガナ</option>
                        <option value="responder_contact">対応者連絡先</option>
                        <option value="email">メールアドレス</option>
                        <option value="zipcode">郵便番号</option>
                        <option value="prefectures">都道府県</option>
                        <option value="city">市区町村</option>
                        <option value="town_area">町域</option>
                        <option value="buildingname_roomnumber">建物名・部屋番号</option>
                    </select>
                    <input type="text" class="form-control col-sm-5" name="searchs[0][search_word]">
                    <select name="searchs[0][select_terms]" class="form-control col-sm-3">
                        <option value="1">と等しい</option>
                        <option value="2">と等しくない</option>
                        <option value="3">を含む</option>
                        <option value="4">を含まない</option>
                    </select>
                    <input type="button" class="btn-success col-sm-1" value="行追加" onclick="createNew()" />
                </div>
                <div id="mydiv"></div>
                <div class="text-right">
                    <input type="submit" value="検索" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container-field">
    <div class="table_position">
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th class="detail_space"></th>
                    <th>会員番号</th>
                    <th>業者</th>
                    <th>調査会社</th>
                    <th>契約者</th>
                    <th>契約者フリガナ</th>
                    <th>別名義</th>
                    <th>契約者連絡先</th>
                    <th>対応者連絡先</th>
                    <th>その他連絡先</th>
                    <th>メールアドレス</th>
                    <th>郵便番号</th>
                    <th>都道府県</th>
                    <th>市区町村</th>
                    <th>町域</th>
                    <th>建物名・部屋番号</th>
                    <th>対応者</th>
                    <th>対応者フリガナ</th>
                    <th>備考</th>
                    <th title="「○」アンケート回答済み
                    「×」アンケート未回答
                    「△」アンケート回答途中">アンケート</th>
                    <th>登録ユーザー</th>
                </tr>
            </thead>
            <tbody class="table">
            @foreach($clients as $client)
                <tr>
                    <td>
                        <button onclick="location.href='{{ action('ClientController@edit', ['id' => $client->id]) }}'" class="btn-sm btn-info">編集</button>
                    </td>
                    <td>{{ $client->member_id }}</td>
                    <td>{{ $client->trader_name }}</td>
                    <td>{{ $client->corp_name }}</td>
                    <td>{{ $client->contractor }}</td>
                    <td>{{ $client->contractor_kana }}</td>
                    <td>
                        @if($client["another_name"] == "1") ○
                        @elseif($client["another_name"] == "0") --
                        @endif
                    </td>
                    <td>{{ $client->contractor_contact }}</td>
                    <td>{{ $client->responder_contact }}</td>
                    <td>{{ $client->other_contact }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->zipcode }}</td>
                    <td>{{ $client->prefectures }}</td>
                    <td>{{ $client->city }}</td>
                    <td>{{ $client->town_area }}</td>
                    <td>{{ $client->buildingname_roomnumber }}</td>
                    <td>{{ $client->responder }}</td>
                    <td>{{ $client->responder_kana }}</td>
                    <td>{{ $client->note }}</td>
                    <td>{{ $client->disp_name }}</td>
                    <td>{{ $client->username }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
<script>
    var i = 1;
    function createNew() {
        $("#mydiv").append(
            '<div class="form-group row">'+
                '<select name="searchs[' + i + '][select_column]" class="form-control col-sm-3">'+
                    '<option value="trader">業者</option>'+
                    '<option value="survey">調査会社</option>'+
                    '<option value="member_id">会員番号</option>'+
                    '<option value="contractor">契約者</option>'+
                    '<option value="contractor_kana">契約者フリガナ</option>'+
                    '<option value="contractor_contact">契約者連絡先</option>'+
                    '<option value="responder">対応者</option>'+
                    '<option value="responder_kana">対応者フリガナ</option>'+
                    '<option value="responder_contact">対応者連絡先</option>'+
                    '<option value="email">メールアドレス</option>'+
                    '<option value="zipcode">郵便番号</option>'+
                    '<option value="prefectures">都道府県</option>'+
                    '<option value="city">市区町村</option>'+
                    '<option value="town_area">町域</option>'+
                    '<option value="buildingname_roomnumber">建物名・部屋番号</option>'+
                '</select>'+
                '<input type="text" class="form-control col-sm-5" name="searchs[' + i + '][search_word]">'+
                '<select name="searchs[' + i + '][select_terms]" class="form-control col-sm-3">'+
                    '<option value="1">と等しい</option>'+
                    '<option value="2">と等しくない</option>'+
                    '<option value="3">を含む</option>'+
                    '<option value="4">を含まない</option>'+
                '</select>'+
            '</div>'
        );
        i++;
    }
</script>
@endsection