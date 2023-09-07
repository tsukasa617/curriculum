@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">詳細検索</span>
</div>
<div class="container">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item1" aria-selected="true">顧客</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item2" aria-selected="false">案件</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="item1" role="tabpanel" aria-labelledby="item1-tab">
            <form action="{{ action('SearchController@client_result') }}" method="POST">
            {{ csrf_field() }}
                <div class="border" style="padding:10px 20px;">
                    <div class="form-group row" id="client_divs_0">
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
                        <input type="button" class="btn-success col-sm-1" value="行追加" onclick="ClientNew()" />
                        <!-- <button onclick="createNew()" class="btn btn-success col-sm-1">行追加</button> -->
                    </div>
                    <div id="clientdiv"></div>
                    <div class="text-right">
                        <input type="submit" value="検索" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="item2" role="tabpanel" aria-labelledby="item2-tab">
            <form action="{{ action('SearchController@matter_result') }}" method="POST">
            {{ csrf_field() }}
                <div class="border" style="padding:10px 20px;">
                    <div class="form-group row" id="matter_divs_0">
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
                        <input type="button" class="btn-success col-sm-1" value="行追加" onclick="MatterNew()" />
                    </div>
                    <div id="matterdiv"></div>
                    <div class="text-right">
                        <input type="submit" value="検索" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    var i = 1;
    function ClientNew() {
        $("#clientdiv").append(
            '<div class="form-group row" id="client_divs_' + i + '">'+
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
                '<input type="button" class="btn-danger col-sm-1 delbtn" value="行削除" />'+
            '</div>'
        );
        
        i++;
    }
    var j = 1;
    function MatterNew() {
        $("#matterdiv").append(
            '<div class="form-group row id="matter_divs_' + j + '">'+
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
                '<input type="button" class="btn-danger col-sm-1 delbtn" value="行削除" />'+
            '</div>'
        );
        j++;
    }

    $(document).on("click", ".delbtn", function() {
        $(this).parent().remove();
    });

</script>
@endsection