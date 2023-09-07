@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">案件一覧</span>
</div>
<div class="container">
    <div>
        <ul class="matter_all_sub">
            <div class="matter_all_search">
                <form action="" method="POST">
                {{ csrf_field() }}
                    <li><input type="text" class="form-control" name="" placeholder="顧客情報を検索出来ます"></li>
                    <li><button class="btn btn-outline-secondary">検索</button></li>
                </form>
            </div>
            <div>
                <!--<li><button class="btn btn-outline-secondary"> <a href="">EXCEL出力</a> </button></li>
                <li><button onclick="location.href=''" class="btn btn-info">戻る</button></li>-->
            </div>
        </ul>
    </div>


    <div class="table_position">
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th class="detail_space"></th>
                    <th>ステータス</th>
                    <th>申請状況</th>
                    <th>所属</th>
                    <th>担当者</th>
                    <th>HSA担当者</th>
                    <th>契約者</th>
                    <th>対応者</th>
                    <th>契約者連絡先</th>
                    <th>対応者連絡先</th>
                    <th>その他連絡先</th>
                    <th>メールアドレス</th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach ($matters as $matter)
                <tr>
                    <td><a onclick="location.href='{{ action('MatterController@detail',['id'=>$matter->id]) }}'" class="btn-sm btn-info">詳細</a></td>
                    <td>{{ $matter->status_name }}</td>   <!-- ステータス -->
                    <td>{{ $matter->application_status }}</td>     <!-- 申請状況 -->
                    <td>{{ $matter->belongs }}</td>    <!-- 所属 -->
                    <td>{{ $matter->pic }}</td>    <!-- 担当者 -->
                    <td>{{ $matter->hsa_pic }}</td>    <!-- HSA担当者 -->
                    <td>{{ $matter->contractor }}</td>    <!-- 契約者 -->
                    <td>{{ $matter->responder }}</td>    <!-- 対応者 -->
                    <td>{{ $matter->contractor_contact }}</td>    <!-- 契約者連絡先 -->
                    <td>{{ $matter->responder_contact }}</td>    <!-- 対応者連絡先 -->
                    <td>{{ $matter->other_contact }}</td>    <!-- その他連絡先 -->
                    <td>{{ $matter->email }}</td>    <!-- メールアドレス -->
                </tr>
                @endforeach
            </tbody>
        </table>
        @if (!$matters->isEmpty())
            {{ $matters->links() }}
        @endif
    </div>
</div>
@endsection