@extends('main')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Configurar variáveis</h1>
        </div>
        <div class="card-body">
            <form class="d-flex align-items-end" method="post" action="{{ route('imageVariable.store') }}">
                @csrf
                @method('post')
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <div class="w-25">
                    <label for="name">Adicione uma variável</label>
                    <input class="form-control" type="text" name="name" placeholder="">
                </div>
                <button class="btn btn-success ml-2" type="submit">Adicionar</button>
            </form>
        </div>
        @if ($variables)
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($variables as $variable)
                                <tr>
                                    <td>{{ $variable->name }}</td>
                                    <td>
                                        <form action="{{ route("imageVariable.destroy", $variable) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">remover</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
    </div>

@endsection

@section('javascripts_bottom')
@endsection('javascripts_bottom')
