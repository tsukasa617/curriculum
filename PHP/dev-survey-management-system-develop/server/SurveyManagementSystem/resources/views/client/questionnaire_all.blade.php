@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">アンケート回答一覧</span>
</div>
<div class="container">
    <div class="table_position">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="detail_space"></th>
                    <th>会員番号</th>
                    <th>契約者</th>
                    <th>フリガナ</th>
                    <th>連絡先</th>
                    <th>メールアドレス</th>
                </tr>
            </thead>
            <tbody class="table">
            @foreach($answers as $answer)
                <tr>
                    <td><a href="{{ action('ClientController@questionnaire_detail', ['id' => $answer->id]) }}" role="button" class="btn btn-sm btn-info">詳細</a></td>
                    <td>{{ $answer->member_id }}</td>
                    <td>{{ $answer->contractor }}</td>
                    <td>{{ $answer->contractor_kana }}</td>
                    <td>{{ $answer->contractor_contact }}</td>
                    <td>{{ $answer->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection