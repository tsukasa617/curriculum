@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <h2 style="margin-top: 10px">ページが見つかりません</h2>
        <p style="padding-top: 4px">お探しのページは、移動または削除された可能性があります。</p>
    </div>
    <div>
        <ul>
            <li><button type="button" onclick="history.back()"  class="btn btn-secondary">戻る</button></li>
            <li><button onclick="location.href='{{ action('SurveyController@index') }}'" class="btn btn-secondary">ログイン画面へ</button></li>
        </ul>
    </div>
    
</div>
@endsection