@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">CSVファイルインポート</span>
    </div>

    @if ($errors->any())    
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            <ul>
            <!-- 更新メッセージ -->
                <div class="message">
                    {{ session('message') }}
                </div>
            </ul>
        </div>
    @endif

    @if (session('error_message'))
        <div class="alert alert-danger">
            <ul>
            <!-- 更新メッセージ -->
                <div class="message">
                    {{ session('error_message') }}
                </div>
            </ul>
        </div>
    @endif

    <div class="text-right">
        <button onclick="location.href='{{ action('TraderController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
    </div>
    <form action="{{ action('TraderController@csv_import_check') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        <input type="file" class="form-control-file" name="csv_file" required>
        <input type="submit" value="インポート" class="btn btn-primary">
    </form>
@endsection