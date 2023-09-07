@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div style="margin-bottom: 50px;">
        <h2>ただいま障害が発生しています。管理者にお問い合わせください。</h2>
    </div>
    <button onclick="location.href='{{ action('SurveyController@index') }}'" class="btn btn-secondary">ログイン画面へ</button>
</div>
@endsection