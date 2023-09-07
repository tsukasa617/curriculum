@extends('/layout/create_search')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;"></span>
</div>
<div class="container">
    <div class="table_position">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="detail_space"></th>
                    <th>契約者連絡先</th>
                    <th>業者</th>
                    <th>調査会社</th>
                    <th>契約者</th>
                    <th>対応者</th>
                </tr>
            </thead>
            <tbody class="table">
                <?php $val = "a"; ?>
                @foreach ($clients as $client)
                    <tr id="<?php echo $val; ?>">
                        <input type="hidden" value="{{ $client['id'] }}" name="id" id="id">
                        <td><a href="javascript:void(0);" /*onclick="returnView()"*/ class="btn-sm btn-info">選択</a></td>
                        <td>{{ $client['contractor_contact'] }}</td>   <!-- 契約者連絡先 -->
                        <td>{{ $client['trader_name'] }}</td>    <!-- 業者 -->
                        <td>{{ $client['corp_name'] }}</td>    <!-- 調査会社 -->
                        <td>{{ $client['contractor'] }}</td>    <!-- 契約者 -->
                        <td>{{ $client['responder'] }}</td>    <!-- 対応者 -->
                        <input type="hidden" value="{{ $client['member_id'] }}" name="member_id" id="member_id">
                        <input type="hidden" value="{{ $client['contractor_contact'] }}" name="contractor_contact" id="contractor_contact">
                        <input type="hidden" value="{{ $client['trader'] }}" name="trader" id="trader">
                        <input type="hidden" value="{{ $client['survey'] }}" name="survey" id="survey">
                        <input type="hidden" value="{{ $client['zipcode'] }}" name="zipcode" id="zipcode">
                        <input type="hidden" value="{{ $client['prefectures'] }}" name="prefectures" id="prefectures">
                        <input type="hidden" value="{{ $client['city'] }}" name="city" id="city">
                        <input type="hidden" value="{{ $client['town_area'] }}" name="town_area" id="town_area">
                        <input type="hidden" value="{{ $client['buildingname_roomnumber'] }}" name="buildingname_roomnumber" id="buildingname_roomnumber">
                    </tr>
                    <?php $val++; ?>
                @endforeach
            </tbody>
        </table>
        @if (!$clients->isEmpty())
            {{ $clients->links() }}
        @endif
    </div>
</div>
@endsection