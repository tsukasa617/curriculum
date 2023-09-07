@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">調査会社情報詳細</span>
    </div>

    <div>
        <ul class="sub_menu any_method">
            <li>
                <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#modal1">削除</button>
            </li>
            <li>
                <button onclick="location.href='{{ action('SurveyCorpController@edit', ['id' => $survey_corp->id]) }}'" class="btn btn-info">編集</button>
            </li>
            <li>
                <button onclick="location.href='{{ action('SurveyCorpController@all') }}'" class="btn btn-secondary menu-add-right">一覧に戻る</button>
            </li>
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
                                <a href="{{ action('SurveyCorpController@delete',['id' => $survey_corp['id']]) }}">
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
                <th>会社名</th>
                <td>{{ $survey_corp["survey_name"] }}</td>
            </tr>
            <tr>
                <th>郵便番号</th>
                <td>{{ substr_replace($survey_corp["survey_zipcode"], '-', 3, 0) }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $survey_corp["survey_address"] }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $survey_corp["survey_phone"] }}</td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td><a href="mailto:{{ $survey_corp['survey_mail'] }}">{{ $survey_corp["survey_mail"] }}</a></td>
            </tr>
            <tr>
                <th>Webサイト</th>
                <td><a href="{{ $survey_corp['survey_url'] }}">{{ $survey_corp["survey_url"] }}</a></td>
            </tr>
        </table>
    </div>
</div>
@endsection