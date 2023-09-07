@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">調査会社一覧</span>
</div>
<div class="container">
    <div>
        <ul class="sub_menu">
            <a href="" class="btn btn-primary">新規登録</a>
        </ul>
    </div>
    <div class="table_position">
        <table class="table table-bordered">
            <thead>
                <tr class="d-flex">
                    <th class="col-2 text-center header">ログインID</th>
                    <th class="col-4 text-center header">会社名</th>
                    <th class="col-2 text-center header">登録ユーザー</th>
                    <th class="col-1"></th>
                    <th class="col-3"></th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach ($values as $value)
                    <tr class="d-flex">
                        <td class="col-2">{{ $value['login'] }}</td>
                        <td class="col-4">{{ $value['corp_name'] }}</td>
                        <td class="col-2">{{ $value['username'] }}</td>
                        <td class="col-1"><a href="" class="btn btn-secondary">編集</a></td>
                        <td class="col-3 text-center header"><a href="" class="btn btn-outline-danger">パスワードリセット</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
