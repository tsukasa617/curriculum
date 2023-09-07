@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div>
  <span style="font-size: 30px; margin-left: 60px;">アカウント詳細</span>
</div>
<div class="container">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">ログインID</th>
        <th scope="col">氏名</th>
        <th scope="col">権限</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ Auth::user()->login }}</td>
        <td>{{ Auth::user()->username }}</td>
        <td>{{ Auth::user()->auth }}</td>
      </tr>
    </tbody>
  </table>

  <div class="text-right">
    <button onclick="location.href='{{ action('UserController@all') }}'" class="btn btn-primary">一覧に戻る</button>
  </div>
</div>
</div>

@endsection