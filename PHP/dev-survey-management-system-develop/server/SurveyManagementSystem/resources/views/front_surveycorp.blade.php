@extends('layout/layout')
@section('title', '管理システム')

@section('content')
<?php 
    $a = true;
    $b = true;    
?>
<div class="container-fluid">
    <div style="margin: 30px">
        <h2>Information ※調査会社</h2>
        @if ($a)
            <div>
                <span>未完了の案件があります ※表示例　最新5件まで表示</span>
            </div> 
            <div class="table_position">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>会員番号</th>
                            <th>契約者</th>
                            <th>契約者連絡先</th>
                            <th>メールアドレス</th>
                            <th>都道府県</th>
                            <th>市区町村</th>
                        </tr>
                    </thead>
                    <tbody class="table">
                    @foreach($matters as $matter)
                        <tr>
                            <td>{{ $matter->member_id }}</td>
                            <td>{{ $matter->contractor }}</td>
                            <td>{{ $matter->contractor_contact }}</td>
                            <th>{{ $matter->email }}</th>
                            <td>{{ $matter->prefectures }}</td>
                            <td>{{ $matter->city }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
        <div>

        </div>
    </div>
</div>
@endsection