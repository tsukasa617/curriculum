@extends('layout/layout')
@section('title', '管理システム')

@section('content')
<?php 
    $a = true;
    $b = true;    
?>

<div class="container">
    <div style="margin: 30px">
        <div>
            <p style="font-size: 2.7rem">Information</p>
        </div>
        <div style="margin-top: 15px;">
            <h3 style="color: red; line-height: 2em;">このアカウントには閲覧権限が設定されていません。<br>一覧画面を閲覧するには、管理者からの閲覧権限の設定が必要です。</h3>
        </div>
    </div>
</div>
@endsection