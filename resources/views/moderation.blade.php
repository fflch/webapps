@extends('laravel-usp-theme::master')
@section("content")

@foreach($moderations as $moderation)

<div class="card text-left">
  <div class="card-body">
    <b>Domínio: </b><p class="card-text">{{$moderation->dominio}}</p>
    <b>Justificativa:</b><p class="card-text">{{$moderation->justificativa}}</p>
    @if( $moderation->tipo == 'outro_app' )
        <b>Tipo de solicitação: </b><p>{{ $moderation->tipo }}</p>
    @endif
    <b>URL: </b><p><a href="{{ $moderation->url_github }}" target="_blank"> {{ $moderation->url_github }} </a></p>
    <b>Requerente: </b><p> {{ $moderation->user->name }} </p>
    <b>Status: </b><p>{{ $moderation->status }}</p>
  </div>
</div>


<a href="/aprovar/{{ $moderation->id }}" class="btn btn-primary">Aprovar</a>

<form method="post" action="/negado/{{ $moderation->id }}">
  @method('delete')
  @csrf
  <button type="submit" class="btn btn-danger" onClick="return confirm('Tem certeza?');">Negar</button>
</form>

@endforeach

@endsection