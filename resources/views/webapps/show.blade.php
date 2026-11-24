@extends('main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-text">{{ $webapp->name }}</h1>
        </div>
        <div class="card-body">
            <b>Domínio: </b>
            <p>{{ $webapp->dominio }}</p>
            <b>Imagem:</b>
            <p>{{ $webapp->dockerImage->name }}</p>
            <b>Versão:</b>
            <p>{{ $webapp->version }}</p>
            <b>Justificativa:</b>
            <p class="card-text">{{ $webapp->justificativa }}</p>
            <b>Solicitante: </b>
            <p>{{ $webapp->user->name }}</p>
        </div>

        <div class="card-body d-flex justify-content-center">
            <div class="card w-25 mr-4">
                <div class="card-header">
                    <p class="mb-0">
                        <b>Banco de Dados</b>
                    </p>
                </div>
                <div class="card-body d-flex flex-column">
                    <a href="{{ route('webapps.databases', $webapp) }}" class="btn btn-primary">Gerenciar bancos de
                        dados</a>
                    <br>
                </div>
            </div>
            <div class="card w-25 mr-4">
                <div class="card-header">
                    <p class="mb-0">
                        <b>Bucket</b>
                    </p>
                </div>
                <div class="card-body d-flex flex-column">
                    @if ($webapp->Bucket != null)
                        <p>Nome: {{ $webapp->Bucket->name}} </p>
                        <p>Chave: {{ $webapp->Bucket->key_name}} </p>
                        <p>Id: {{ $webapp->Bucket->key_id}} </p>
                        <p>Secret: {{ $webapp->Bucket->key_secret}} </p>
                    @else  
                        <form class="d-flex flex-column" action="{{ route('bucket.store') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="app_id" value="{{ $webapp->id }}">
                            <input type="hidden" name="app_name" value="{{ $webapp->name }}">
                            <button type="submit" class="btn btn-primary">Criar Bucket</button>
                        </form>
                    @endif
                    <br>
                </div>
            </div>
            <div class="card w-25">
                <div class="card-header">
                    <p class="mb-0">
                        <b>Aplicação</b>
                    </p>
                </div>
                <div class="card-body d-flex flex-column">
                    <a class="btn btn-primary mb-3" href="/webapps/{{ $webapp->id }}/edit">Alterar imagem docker</a>
                    <a class="btn btn-primary mb-3" href="{{ route('appVariable.show', $webapp->id) }}">Configurar
                        variáveis de
                        ambiente</a>
                    @if ($webapp->status == 'Solicitado')
                        <a href="/portainer/{{ $webapp->id }}/store" class="btn btn-primary">Publicar aplicação</a>
                    @else
                        <a href="/portainer/{{ $webapp->id }}/update" class="btn btn-primary">Atualizar aplicação</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
