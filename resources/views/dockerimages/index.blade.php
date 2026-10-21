@extends('main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Imagens</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($docker_images as $image)
                            <tr>
                                <td>{{ $image->name }}</td>
                                <td>{{ $image->path }}</td>
                                <td>
                                    <a class="btn btn-warning" href="{{ route('dockerimages.edit', $image) }}">Editar</a>
                                    <a class="btn btn-danger" href="{{ route('dockerimages.destroy', $image) }}">Deletar</a>
                                    <a class="btn btn-success"
                                        href="{{ route('dockerimages.variables', $image) }}">Variáveis</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
