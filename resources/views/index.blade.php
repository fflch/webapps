@extends('laravel-usp-theme::master')
@section('content')


@if(auth()->user())
<a href="/minhas-solicitacoes" class="btn btn-primary">Minhas solicitações</a>
<a href="/create" class="btn btn-success">Criar</a>
@else
<p>Para solicitar um site você precisa <a href="/login">relizar login</a>.</p>
@endif

@if(in_array(auth()->user()->codpes ?? [], explode(',',config('webapps.admins')) ))
<a href="/moderation" class="btn btn-primary">Moderação</a>
@endif

@endsection