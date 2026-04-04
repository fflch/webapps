@extends('laravel-usp-theme::master')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header fw-bold"><b>Solicitação</b></div>
        <div class="card-body">
            <form method="post" action="/store">
                @method('post')
                @csrf
                @include('partials.form_solicitacao')
            </form>
        </div>
    </div>
@endsection
