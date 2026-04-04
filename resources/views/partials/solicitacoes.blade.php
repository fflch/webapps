<div class="row">
    @foreach($webapps as $webapp)
    <div class="col-3">
        <div class="card">
            <div class="card-header"><b>Informações da solicitação</b></div>
            <div class="card-body">
                 <b>Domínio: </b><p class="card-text">{{$webapp->dominio}}</p>
                <b>Justificativa:</b><p class="card-text">{{$webapp->justificativa}}</p>
                <b>Tipo de solicitação: </b><p>{{ $webapp->tipo == 'outro_app' ? 'Outro App' : 'Drupal' }}</p>
                <b>URL: </b><p><a href="https://github.com/{{ $webapp->url_github }}" target="_blank">https://github.com/{{ $webapp->url_github }} </a></p>
                <b>Status: </b><p>{{ $webapp->status }}</p>
                <b>Solicitante: </b><p>{{ $webapp->user->name }}</p>
                <div class="row">
                @if($webapp->status == 'Negado' && auth()->user()->id == $webapp->user_id)
                <div class="col">
                    <a href="/edit/{{ $webapp->id }}" class="btn btn-primary">Alterar pedido</a>
                </div>
                @endif

                    @if(in_array(auth()->user()->codpes ?? [], explode(',',config('webapps.admins'))))
                        <div class="col">
                            <a href="/aprovar/{{ $webapp->id }}" class="btn btn-primary"><i class="fas fa-thumbs-up"></i> Aprovar</a>
                        </div>
                        <div class="col">
                        <form method="post" action="/reprovar/{{ $webapp->id }}">
                            @method('put')
                            @csrf
                            <button type="submit" class="btn btn-danger" onClick="return confirm('Tem certeza?');"><i class="fas fa-thumbs-down"></i> Negar</button>
                        </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>