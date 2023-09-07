@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <h2 style="margin-top: 10px">長時間経過しました。</h2>
    </div>
    <div>
        <p style="padding-top: 4px">安全のため、管理者の方はもう一度ログインして下さい。<br>
        申し込みフォーム入力中の方はお手数ですが、最初からやり直してください。</p>
        <button onclick="location.href='{{ action('SurveyController@index') }}'" class="btn btn-secondary">ログイン画面へ</button>
        <button onclick="location.href='{{ action('LpController@all') }}'" class="btn btn-secondary">申し込みトップへ</button>
    </div>
    
</div>
@endsection