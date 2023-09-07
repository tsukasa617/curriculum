@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">顧客一覧</span>
</div>
<div class="container-fluid">
    <div>
        <ul class="sub_menu">
        {{--
            <a href="{{ action('ClientController@create') }}" class="btn btn-primary">新規登録</a>
            <button class="btn btn-outline-secondary">
                <a href="">EXCEL出力</a>
            </button>
            <button onclick="location.href=''" class="btn btn-info">戻る</button>
        --}}
        </ul>
    </div>
    <div class="table_position">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="detail_space"></th>
                    <th class="detail_space"></th>
                    <th>所属</th>
                    {{-- <th>進捗</th> --}}
                    <th>契約者</th>
                    <th>契約者連絡先</th>
                    <th>都道府県</th>
                    <th>市区町村</th>
                </tr>
            </thead>
            <tbody class="table">
            @foreach($clients as $client)
                <tr>
                    <td><a href="{{ action('ClientController@detail', ['id' => $client->id]) }}" role="button" class="btn btn-sm btn-info">詳細</a></td>
                    <td><button onclick="location.href='{{ action('ClientController@matter', ['id' => $client->id]) }}'" class="btn btn-sm btn-success">該当案件</button></td>
                    <td>{{ $client->belongs }}</td>
                    {{-- <td>参照</td> --}}
                    <td>{{ $client->contractor }}</td>
                    <td>{{ $client->contractor_contact }}</td>
                    <td>{{ $client->prefectures }}</td>
                    <td>{{ $client->city }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection