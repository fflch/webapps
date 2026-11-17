@extends('main')
@section("content")
<div class="card">
    <div class="card-header">
        <h3>{{ $webapp->dominio }}</h3>
        <p>Gerenciamento de banco de dados</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="w-25">
                <form action="{{ route('gwdb.store') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="col mb-2">
                        <label>Nome do DB:</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="col mb-2">
                        <label>Driver do DB:</label>
                        <select class="form-control" name="driver">
                            <option value="">Selecione o tipo de banco de dados</option>
                            <option value="postgres">PostgreSQL</option>
                            <option value="mariadb">MariaDB</option>
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn btn-success" type="submit">Criar</button>
                    </div>
                </form>
            </div>
            <div class="w-75">
                <table class="table table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Driver</th>
                        </tr>
                    </thead>
                    @if ($webapp->AppDatabase) 
                        <tbody>
                            @foreach ($webapp->AppDatabase as $database)
                                <tr>
                                    <td>{{ $database->name}} </td>
                                    <td>{{ $database->driver }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

@endsection