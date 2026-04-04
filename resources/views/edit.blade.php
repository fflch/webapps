@extends('laravel-usp-theme::master')
@section('content')
<div class="card">
    <div class="card-header"><b>Editar</b></div>
    <div class="card-body">
        <form method="post" action="/update/{{ $webapp->id }}">
            @method("put")
            @csrf
            @include('partials.form_solicitacao')
        </form>
    </div>
</div>

@endsection