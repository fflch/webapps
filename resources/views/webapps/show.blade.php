@extends('main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-text">{{ $webapp->name }}</h1>
        </div>
        <div class="card-body">
            <b>Domínio: </b>
            <p>{{ $webapp->dominio}}</p>
            <b>Imagem:</b>
            <p>{{ $webapp->dockerImage->name }}</p>
            <b>Versão:</b>
            <p>{{ $webapp->version  }}</p>
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
                    @if (!$webapp->AppDatabase)
                        <a href="/webapps/{{ $webapp->id }}/database/store" class="btn btn-primary">Criar bancos de
                            dados</a>
                    @else
                        <a href="/gwmariadb/{{ $webapp->AppDatabase->id }}" class="btn btn-primary mb-3">Ver banco de dados</a>
                        <a href="/gwmariadb/testconnection" class="btn btn-secondary">Testar conexão</a>
                    @endif
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
                    <a href="/bucket/store/{{ $webapp->id }}" class="btn btn-primary mb-3">Criar Bucket</a>
                    <a href="/bucket/show/{{ $webapp->id }}" class="btn btn-primary mb-3">Ver dados bucket</a>
                    <a href="/bucket/delete/{{ $webapp->id }}" class="btn btn-danger">Excluir bucket</a>
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
                    <a class="btn btn-primary mb-3" href="{{ route('appVariable.show', $webapp->id) }}">Configurar variáveis de
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
