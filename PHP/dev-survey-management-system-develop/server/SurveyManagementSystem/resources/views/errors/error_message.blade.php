@extends('../layout/layout')
@section('title', '管理システム')

@section('content')

<div class="container-field">
    @if (session('message'))
    <div class="alert alert-danger">
        <ul>
            <div class="message">
                {{ session('message') }}
            </div>
        </ul>
    </div>
    @endif
</div>
@endsection