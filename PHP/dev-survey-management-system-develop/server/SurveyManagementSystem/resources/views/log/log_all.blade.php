@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
    
<div class="container">
    <div>
        <span style="font-size: 30px;">ログ管理一覧</span>
    </div>

    <div>
        <ul class="matter_all_sub">
            <div class="matter_all_search">
                <form action="{{ action('LogController@filter_search') }}" method="POST">
                    {{ csrf_field() }}
                    <li class="list">
                        <input type="text" class="form-control" name="search" placeholder="キーワード検索">
                    </li>
                    <li>
                        <input type='submit' class="btn btn-primary" value='検索'>
                    </li>
                </form>
            </div>
        </ul>
    </div>
    <div>
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th class="col-3 text-center header">操作時刻</th>
                    <th class="col-3 text-center header">アカウント名</th>
                    <th class="col-3 text-center header">操作内容</th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach($logs as $log)
                    <tr>
                        <td class="col-3">{{ $log->created_at }}</td>
                        <td class="col-3">{{ $log->login }}：{{ $log->username }}</td>
                        <td class="col-2">{{ $log->log }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $logs->links() }}
    </div>
</div>
@endsection
