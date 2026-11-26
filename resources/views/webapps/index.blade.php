@extends('main')
@section("content")
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Apps</h3>
        <a class="btn btn-success" href="{{ route('webapps.create') }}">Novo App</a>
    </div>
    <div class="card-body">
        <div class="row">
            <table class="table table-stripped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Versão</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($webapps as $webapp)
                        <tr>
                            <td>{{ $webapp->dominio }}</td>
                            <td>{{ $webapp->dockerImage->path }}</td>
                            <td>{{ $webapp->version }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ route("webapps.show", $webapp) }}">Ver</a>
                                <a class="btn btn-warning" href="{{ route("webapps.edit", $webapp) }}">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
