@extends('../layout/layout')
@section('title', '管理システム')

@section('content')
<div>
    <span style="font-size: 30px; margin-left: 60px;">進捗登録</span>
</div>
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
    @if (session('success_message'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('success_message') }}</li>
        </ul>
    </div>
    @endif
    <div class="text-right">
        {{-- <button onclick="location.href='{{ action('') }}'" class="btn btn-info">一覧に戻る</button> --}}
    </div>
    <form action="{{ action('ProgressController@add') }}" method="POST">

        <div class="form-group">
            <label>会員番号</label>
            <b><font color="red">※必須</font></b>
            <input type="text" class="form-control" name="member_id" value="{{ old('member_id') }}" maxlength="10" required>
        </div>

        <div class="form-group">
            <label>依頼元業者（カテゴリ）</label>
            <b><font color="red">※必須</font></b>
            <select name="trader" class="form-control" required>
            <option value="" selected>業者を選択してください</option>
                @foreach ($traders as $trader)
                    <option value="{{ $trader['id'] }}" @if(old('requester')== $trader['id']) selected @endif>{{ $trader['trader_name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>現調日</label>
            <input type="date" class="form-control" name="current_date" value="{{ old('current_date') }}">
        </div>

        {{ csrf_field() }}
        <div class="text-right">
            <input type="submit" value="登録" class="btn btn-primary">
        </div>
    </form>
</div>
@endsection