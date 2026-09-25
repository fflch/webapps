@extends('main')
@section('content')
<div>
  <div>
      <h1>{{ $webapp->dominio }}</h1>
  </div>
  <div>
    <div class="w-50">
      @if ($webapp->appVariables->isNotEmpty())
        <p>Configure as variáveis de ambiente da aplicação:</p>
        <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th>Nome</th>
              <th>Valor</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($webapp->appVariables as $variable)
              <tr>
                <td>
                  {{ $variable->imageVariable->name }}
                </td>
                <td>
                  <form class="d-flex justify-content-between" method="post"
                    action="{{ route('appVariable.update', $variable->id) }}">
                    @csrf
                    @method('put')
                    <div class="input-group mr-4">
                      <input aria-label="env_variable_input" name="value" type="text"
                          class="form-control w-50" value="{{ $variable->value }}">
                    </div>
                    <button class="btn btn-success" type="submit">Salvar</button>
                </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <small>
            Para adicionar as informações de banco de dados, utilize as variáveis:
        </small>
      @else
        <p>Nenhuma variável cadastrada para este app.</p>
      @endif
    </div>
  </div>
</div>
@endsection

@section('javascripts_bottom')
@endsection('javascripts_bottom')
