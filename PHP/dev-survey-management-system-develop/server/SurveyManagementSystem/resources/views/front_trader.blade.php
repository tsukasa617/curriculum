@extends('layout/layout')
@section('title', '管理システム')

@section('content')
<?php 
    $a = true;
    $b = true;    
?>
<div class="container-fluid">
    <div style="margin: 30px">
        <h2>Information　※元請業者</h2>
        <div>
            <span style="color: red">調査会社に振り分けていない案件があります</span>
        </div>
        <div class="table_position">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>会員番号</th>
                        <th>所属</th>
                        <th>契約者</th>
                        <th>契約者連絡先</th>
                        <th>都道府県</th>
                        <th>市区町村</th>
                    </tr>
                </thead>
                <tbody class="table">
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->member_id }}</td>
                        <td>{{ $client->belongs }}</td>
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
</div>
@endsection