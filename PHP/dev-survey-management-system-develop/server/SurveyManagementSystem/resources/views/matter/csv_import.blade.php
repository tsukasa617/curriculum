@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container">
    <div>
        <span style="font-size: 30px;">CSVファイルインポート</span>
    </div>

    @if ($errors->any())    
        <div class="alert-danger csv-message">
            <!-- エラーメッセージ -->
            @php 
                #数字が０から始まるので１から始めたい
                #数字の前後を削除
                $subject = implode($errors->all());
                $search = ['values.', '.survey_name', '.member', '.contractor', '.address', '.contact_method', '。'];
                $replace = ['', '', '', '', '', '', "。<br>"];
                $subject = str_replace($search,$replace,$subject);
                #。で区切って配列に変換
                $messages = explode("。", $subject);
                array_pop($messages);
                #数字を取り出し１を足し、文字列にもどす
                $er_messages = array();
                foreach($messages as $message){
                    $number = preg_replace('/[^0-9]/', '', $message);
                    $number = $number + 1;
                    $er_messages[] = preg_replace('/[0-9]/', $number, $message);
                }
                sort($er_messages);
                #出力
                foreach($er_messages as $er_message){
                    print $er_message;
                }
            @endphp
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-danger">
            <ul>
            <!-- 更新メッセージ -->
                <div class="message">
                    {{ session('message') }}
                </div>
            </ul>
        </div>
    @endif

    @if (session('success_message'))
        <div class="alert alert-success">
            <ul>
            <!-- 更新メッセージ -->
                <div class="message">
                    {{ session('success_message') }}
                </div>
            </ul>
        </div>
    @endif

    <div class="text-right">
        <button onclick="location.href='{{ action('MatterController@all') }}'" class="btn btn-secondary">一覧に戻る</button>
    </div>
    <form action="{{ action('MatterController@csv_import_check') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        <input type="file" class="form-control-file" name="csv" required>
        <input type="submit" value="インポート" class="btn btn-primary">
    </form>
</div>
@endsection