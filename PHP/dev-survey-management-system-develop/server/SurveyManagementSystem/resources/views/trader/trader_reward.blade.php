@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<script src="{{ asset('js/checkbox_trader_reward.js') }}"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 
<div class="container container_reward">
    <div>
        <span style="font-size: 30px;">報酬・明細一覧</span>
    </div>

    @if (session('success_message'))
        <div class="alert alert-success">
            <ul>
                <li>{{ session('success_message') }}</li>
            </ul>
        </div>
    @endif
    @if (session('error_message'))
    <div class="alert alert-done">
        <ul>
            <!-- 登録・更新失敗メッセージ -->
            <li>{{ session('error_message') }}</li>
        </ul>
    </div>
    @endif

    <div>
        <ul class="matter_all_sub">
            <div class="matter_all_search" style="margin-left: -5px;">
                <form action="{{ action('TraderController@search_reward') }}" method="POST">
                    {{ csrf_field() }}
                    <li class="list">
                        <input type="text" class="form-control" name="search" placeholder="キーワード検索">
                    </li>
                    <li>
                        <input type='submit' class="btn btn-primary" value='検索'>
                    </li>
                </form>
                <li>
                    <input type='button' class="btn btn-danger" value='削除' id='forget_value' style="display: none">
                </li>
                <li>
                    <input type='button' class="btn btn-primary" value='更新' id='get_value' style="display: none">
                </li>
            </div>
            <div class="reward_button_child">
                <button onclick="location.href='{{ action('TraderController@all') }}'" class="btn btn-secondary">一覧に戻る</button></li>
            </div>
        </ul>
    </div>

    <div>
        <table class="table table-bordered scroll-table">
            <thead>
                <tr>
                    <th style="width: 2em"><input type="checkbox" name="allchecked" id="all"></th>
                    <th>ステータス</th>
                    <th>入金日</th>
                    <th>ID</th>
                    <th>氏名</th>
                    <th>物件名</th>
                    <th>取次店１次</th>
                    <th>取次店２次</th>
                    <th>取次店３次</th>
                </tr>
            </thead>
            <tbody class="table">
                @foreach($trader_rewards as $trader_reward)
                    <tr>
                        @if($trader_reward->client_status_id)
                            <td class="check"><input type="checkbox" name="client_chk[]" value="{{ $trader_reward->client_id }}" class="is"></td>
                            <td>
                                <span>{{ $trader_reward->status_number }}：{{ $trader_reward->status_name }}</span>
                                <input type="hidden" name="status_all_id" class="status_all_id" value="{{ $trader_reward['client_status_id'] }}">
                                    <i class="material-icons" style="cursor: pointer">create</i>
                                    {{-- ボタンを押したら切り替え --}}
                                    <select name="client_status_name" class="form-control client_status_name" name="sta[]" style="width: auto;display: none;">
                                        <option value="{{ $trader_reward->status_name }}" selected>{{ $trader_reward->status_number }}：{{ $trader_reward->status_name }}</option>
                                        @foreach ($client_status as $val)
                                            <option value="{{ $val['id'] }}") >{{ $val['status_number'] }}：{{ $val['status_name'] }}</option>
                                        @endforeach
                                    </select>
                            </td>
                            <td>{{ $trader_reward->payment_date }}</td>
                            <td>{{ $trader_reward->member }}</td>
                            <td>{{ $trader_reward->contractor }}</td>
                            <td>{{ $trader_reward->buildingname }}</td>
                            <td><a href="{{ action('TraderController@detail',['id' => $trader_reward->trader_id, 'client_id' => $trader_reward->client_id]) }}">{{ $trader_reward->trader_id }}:{{ $trader_reward->trader_name }}</a></td>
                            <td></td>
                            <td></td>
                        @elseif($trader_reward->matter_status_id)
                            <td class="check"><input type="checkbox" name="matter_chk[]" value="{{ $trader_reward->matter_id }}" class="is"></td>
                            <td>
                                <span>{{ $trader_reward->status_number }}：{{ $trader_reward->status_name }}</span>
                                <input type="hidden" name="status_all_id" class="status_all_id" value="{{ $trader_reward['matter_status_id'] }}">
                                    <i class="material-icons" style="cursor: pointer">create</i>
                                    {{-- ボタンを押したら切り替え --}}
                                    <select name="matter_status_name" class="form-control matter_status_name" name="sta[]" style="width: auto;display: none;">
                                        <option value="{{ $trader_reward->status_name }}" selected>{{ $trader_reward->status_number }}：{{ $trader_reward->status_name }}</option>
                                        @foreach ($matter_status as $val)
                                            <option value="{{ $val['id'] }}") >{{ $val['status_number'] }}：{{ $val['status_name'] }}</option>
                                        @endforeach
                                    </select>
                            </td>
                            <td>{{ $trader_reward->payment_date }}</td>
                            <td>{{ $trader_reward->member }}</td>
                            <td>{{ $trader_reward->contractor }}</td>
                            <td>{{ $trader_reward->buildingname }}</td>
                            <td><a href="{{ action('TraderController@detail',['id' => $trader_reward->trader_id, 'matter_id' => $trader_reward->matter_id]) }}">{{ $trader_reward->trader_id }}:{{ $trader_reward->trader_name }}</a></td>
                            <td><a href="{{ action('TraderController@detail',['id' => $trader_reward->agency_store_2, 'matter_id_2' => $trader_reward->matter_id]) }}">{{ $trader_reward->agency_store_2 }}：{{ $trader_reward->agency_store_2_name }}</a></td>
                            <td><a href="{{ action('TraderController@detail',['id' => $trader_reward->agency_store_3, 'matter_id_3' => $trader_reward->matter_id]) }}">{{ $trader_reward->agency_store_3 }}：{{ $trader_reward->agency_store_3_name }}</a></td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $trader_rewards->links() }}
    </div>
</div>
@endsection
