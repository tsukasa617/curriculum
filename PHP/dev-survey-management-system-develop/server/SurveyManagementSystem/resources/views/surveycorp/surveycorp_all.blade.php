@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

@php $authoritys = session()->get('authoritys'); @endphp
<div class="container">
    <div>
        <span style="font-size: 30px;">調査会社一覧</span>
    </div>

    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('success_message') }}</li>
        </ul>
    </div>
    @endif

    <div style="margin-bottom:10px">
        @foreach($authoritys as $authorities)
            @if($authorities == "追加")
                <ul class="matter_all_sub">
                    <div>
                        <a href="{{ action('SurveyCorpController@create') }}" class="btn btn-outline-secondary">新規登録</a>
                    </div>
                </ul>
            @endif
        @endforeach
    </div>

    <div>
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    @foreach($authoritys as $authorities)
                        @if($authorities == "削除")
                            <th class="detail_space"></th>
                        @endif
                    @endforeach
                    @foreach($authoritys as $authorities)
                        @if($authorities == "編集")
                            <th class="detail_space"></th>
                        @endif
                    @endforeach
                    <th>管理ID</th>
                    <th>会社名</th>
                    <th>郵便番号</th>
                    <th>住所</th>
                    <th>電話番号</th>
                    <th>メールアドレス</th>
                    <th>Webサイト</th>
                </tr>
            </thead>
            <tbody class="table" >
                @foreach ($values as $value)
                    <tr>
                        @foreach($authoritys as $authorities)
                            @if($authorities == "削除")
                                <td><button onclick="location.href='{{ action('SurveyCorpController@detail', ['id' => $value->id]) }}'" class="btn-sm btn-success">詳細</button></td>
                            @endif
                        @endforeach
                        @foreach($authoritys as $authorities)
                            @if($authorities == "編集")
                                <td><button onclick="location.href='{{ action('SurveyCorpController@edit', ['id' => $value->id]) }}'" class="btn-sm btn-info">編集</button></td>
                            @endif
                        @endforeach
                        <td>{{ $value['id'] }}</td>
                        <td>{{ $value['survey_name'] }}</td>
                        <td>{{ substr_replace($value->survey_zipcode, '-', 3, 0) }}</td>
                        <td>{{ $value['survey_address'] }}</td>
                        <td>{{ $value['survey_phone'] }}</td>
                        <td>{{ $value['survey_mail'] }}</td>
                        <td>{{ $value['survey_url'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
{{ $values->links() }}
</div>
@endsection
