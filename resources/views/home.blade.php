@extends('layouts.master') 
@section('content')

<div class="row justify-content-center mt-1">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">最新公告</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
