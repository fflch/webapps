@extends('main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>{{ $docker_image->name }}</h1>
        </div>
        <div class="card-body">
            <form class="d-flex align-items-end" action="/dockerimages/{{ $docker_image->id }}" method="post">
                @method('patch')
                @csrf
                <div class="w-25">
                    <span class="mb-2">Imagem docker:</span>
                    <input type="text" class="form-control" value="{{ old('path', $docker_image->path) }}" name="path"
                        placeholder="ghcr.io/caminho/nome_da_imagem">
                </div>
                <button type="submit" class="btn btn-success ml-2">salvar</button>
            </form>
        </div>
    </div>
@endsection
