@extends('main')
@section('content')
    <div class="card">
        <div class="card-header col">
            <h1>Adicionar nova imagem:</h1>
        </div>
        <div class="card-body">
            <form action="/dockerimages" method="post" class="w-50">
                @method('post')
                @csrf
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Nome da imagem:</span>
                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" placeholder="sites">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Imagem docker:</span>
                        <input type="text" class="form-control" value="{{ old('path') }}" name="path" placeholder="ghcr.io/caminho/nome_da_imagem">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
