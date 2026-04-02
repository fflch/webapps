<div class="row">
    <div class="col">
        <label><b>Domínio</b></label>
        <input type="text" class="form-control" name="dominio" value="{{ old('dominio', $request->dominio) }}">
    </div>
</div>

<div class="row">
    <div class="col">
        <label><b>Justificativa</b></label>
        <textarea class="form-control" name="justificativa">{{ old('justificativa', $request->justificativa) }}</textarea>
    </div>
</div>

<div class="row" id="url_github" style="display:none;">
    <div class="col">
        <label><b>URL github</b></label>
        <input type="text" class="form-control" name="url_github" value="{{ old('url', $request->url) }}">
    </div>
</div>

<div class="row">
    <div class="col-12">
        <label><b>Tipo</b></label>
    </div>
    <div class="col-1" style="margin-left:15px;">
        <input name="tipo" class="form-check-input" type="radio" value="drupal" @if(old('tipo') == 'drupal') checked @endif>Drupal
    </div>
    <div class="col-1">
        <input name="tipo" class="form-check-input" type="radio" value="outro_app" id="button_outro_app"
        @if(old('tipo') == 'outro_app') checked @endif>Outro app
    </div>
</div>

<div class="row" style="margin-top:20px;">
    <div class="col">
        <button class="btn btn-success" type="submit">Enviar</button>
    </div>
</div>