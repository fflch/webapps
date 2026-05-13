@extends('laravel-usp-theme::master')
@section("content")

<p class="card-text"><a href="/webapps/{{ $webapp->id }}">{{ $webapp->dominio }}</a></p>
    
    <b>Justificativa:</b>
    <p class="card-text">{{ $webapp->justificativa }}</p>
    <b>Tipo de solicitação: </b>
    <p>{{ $webapp->tipo == 'outro_app' ? 'Outro App' : 'Drupal' }}</p>
    @if ($webapp->url_github)
        <b>Repositório Github: </b>
        <p><a href="{{ $webapp->url_github }}" target="_blank">{{ $webapp->url_github }} </a><b>Tag:
            </b>{{ $webapp->version ?? 'não informado'}}</p>
    @endif
    <b>Status: </b>
    <p>{{ $webapp->status }}</p>
    <b>Solicitante: </b>
    <p>{{ $webapp->user->name }}</p>


    <br><br><button class="btn btn-primary">Configurar Banco de Dados (Mônica)</button>
    <br><br><button class="btn btn-primary">Configurar Bucket (Ricardo)</button>
    <br><br><button class="btn btn-primary">Configurar Docker (Augusto)</button>

@endsection