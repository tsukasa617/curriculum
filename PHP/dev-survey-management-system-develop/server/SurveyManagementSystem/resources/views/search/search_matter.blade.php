@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span class="search-result-title">顧客検索結果</span>
    <span class="search-result-count">該当件数：{{ count($matters) }}件</span>
</div>
<div class="d-flex justify-content-between">
    <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="margin-bottom: 5px; margin-left:30px;">再検索</button>
    <button onclick="location.href='{{ action('SearchController@index') }}'" class="btn btn-info pull-right search-index-button"  style="margin-bottom: 5px; margin-right:30px;">検索トップに戻る</button>
</div>
<div class="container float-left" style="margin-bottom: 5px;">
    <div class="collapse" id="collapseExample">
        <form action="{{ action('SearchController@matter_result') }}" method="POST">
        {{ csrf_field() }}
            <div class="jumbotron" style="padding:10px 20px;">
                <div class="form-group row">
                    <select name="searchs[0][select_column]" class="form-control col-sm-3">
                        <option value="trader">業者</option>
                        <option value="survey">調査会社</option>
                        <option value="member_id">会員番号(案件番号)</option>
                        <option value="contractor">契約者</option>
                        <option value="contractor_kana">契約者フリガナ</option>
                        <option value="contractor_contact">契約者連絡先</option>
                        <option value="responder">対応者</option>
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
                    <input type="button" class="btn-success col-sm-1" value="行追加" onclick="createNew2()" />
                </div>
                <div id="mydiv2"></div>
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
                    <th>ステータス</th>
                    <th>申請状況</th>
                    <th>会員番号</th>
                    <th>業者</th>
                    <th>調査会社</th>
                    <th>契約者</th>
                    <th>契約者フリガナ</th>
                    <th>契約者連絡先</th>
                    <th>対応者</th>
                    <th>対応者連絡先</th>
                    <th>その他連絡先</th>
                    <th>メールアドレス</th>
                    <th>郵便番号</th>
                    <th>都道府県</th>
                    <th>市区町村</th>
                    <th>町域</th>
                    <th>建物名・部屋番号</th>
                    <th>登録ユーザー</th>
                </tr>
            </thead>
            <tbody class="table">
            @foreach($matters as $matter)
                <tr>
                    <td>
                        <button onclick="location.href='{{ action('MatterController@detail', ['id' => $matter->id]) }}'" class="btn-sm btn-info">編集</button>
                    </td>
                    <td>{{ $matter->status_name }}</td>
                    <td>{{ $matter->application_status }}</td>
                    <td>{{ $matter->member_id }}</td>
                    <td>{{ $matter->trader_name }}</td>
                    <td>{{ $matter->corp_name }}</td>
                    <td>{{ $matter->contractor }}</td>
                    <td>{{ $matter->contractor_kana }}</td>
                    <td>{{ $matter->contractor_contact }}</td>
                    <td>{{ $matter->responder }}</td>
                    <td>{{ $matter->responder_contact }}</td>
                    <td>{{ $matter->other_contact }}</td>
                    <td>{{ $matter->email }}</td>
                    <td>{{ $matter->zipcode }}</td>
                    <td>{{ $matter->prefectures }}</td>
                    <td>{{ $matter->city }}</td>
                    <td>{{ $matter->town_area }}</td>
                    <td>{{ $matter->buildingname_roomnumber }}</td>
                    <td>{{ $matter->username }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    </div>
<script>
    var j = 1;
    function createNew2() {
        $("#mydiv2").append(
            '<div class="form-group row">'+
                '<select name="searchs[' + j + '][select_column]" class="form-control col-sm-3">'+
                    '<option value="trader">業者</option>'+
                    '<option value="survey">調査会社</option>'+
                    '<option value="member_id">会員番号(案件番号)</option>'+
                    '<option value="contractor">契約者</option>'+
                    '<option value="contractor_kana">契約者フリガナ</option>'+
                    '<option value="contractor_contact">契約者連絡先</option>'+
                    '<option value="responder">対応者</option>'+
                    '<option value="responder_contact">対応者連絡先</option>'+
                    '<option value="email">メールアドレス</option>'+
                    '<option value="zipcode">郵便番号</option>'+
                    '<option value="prefectures">都道府県</option>'+
                    '<option value="city">市区町村</option>'+
                    '<option value="town_area">町域</option>'+
                    '<option value="buildingname_roomnumber">建物名・部屋番号</option>'+
                '</select>'+
                '<input type="text" class="form-control col-sm-5" name="searchs[' + j + '][search_word]">'+
                '<select name="searchs[' + j + '][select_terms]" class="form-control col-sm-3">'+
                    '<option value="1">と等しい</option>'+
                    '<option value="2">と等しくない</option>'+
                    '<option value="3">を含む</option>'+
                    '<option value="4">を含まない</option>'+
                '</select>'+
            '</div>'
        );
        
        j++;
    }
</script>
@endsection