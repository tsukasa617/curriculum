@extends('layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">案件管理</span>
</div>
<div class="container-fluid">
    <div style="margin: 30px;" class="table-space">
        <div class="row">
            <div class="col-md-6 text-center">
                <button type="button" class="btn-lg btn-primary w-50 mt-4" style="font-size: 2.25rem;" onclick="location.href='{{ action('SaletalkController@create') }}'"><a>案件一覧</a></button>
                <p style="margin-top: 6px;">未完了の案件一覧を確認できます</p>
            </div>
            <div class="col-md-6 text-center">
                <button type="button" class="btn-lg btn-primary w-50 mt-4" style="font-size: 2.25rem;" onclick="location.href='{{ action('OrderController@create') }}'"><a>案件登録</a></button>
                <p style="margin-top: 6px;">案件を調査会社に振り分けることができます</p>
            </div>
            <div class="col-md-6 text-center">
                <button type="button" class="btn-lg btn-primary w-50 mt-4" style="font-size: 2.25rem;" onclick="location.href='{{ action('ComplaintController@create') }}'"><a>調査会社一覧</a></button>
                <p style="margin-top: 6px;">調査会社の一覧を確認できます</p>
            </div>
            <div class="col-md-6 text-center">
                <button type="button" class="btn-lg btn-primary w-50 mt-4" style="font-size: 2.25rem;" onclick="location.href='{{ action('ComplaintController@all') }}'"><a>調査会社登録</a></button>
                <p style="margin-top: 6px;">新しく調査会社を登録できます</p>
            </div>
            <div class="col-md-6 text-center">
                <button type="button" class="btn-lg btn-primary w-50 mt-4" style="font-size: 2.25rem;" onclick="location.href='{{ action('InquiryController@create') }}'"><a>完了案件一覧</a></button>
                <p style="margin-top: 6px;">調査が完了した案件を確認できます</p>
            </div>
            <div class="col-md-6 text-center">
                <button type="button" class="btn-lg btn-primary w-50 mt-4" style="font-size: 2.25rem;" onclick="location.href='{{ action('InquiryController@all') }}'"><a>案件ステータス編集</a></button>
                <p style="margin-top: 6px;">案件のステータスの編集ができます</p>
            </div>
        </div>
    </div>
</div>
@endsection