<?php

namespace App\Http\Controllers;

use App\Http\Services\ApiService;
use App\Http\Requests\WebappRequest;
use App\Models\Moderation;
use App\Models\Webapp;
use Illuminate\Http\Client\RequestException;

class SolicitacaoController extends Controller
{
    public function index(){
        $webapps = Webapp::where('user_id',auth()->user()->id)->get();
        return view('solicitacoes', ['webapps' => $webapps]);
    }

    public function edit(Webapp $webapp){
        return view('edit', ['webapp' => $webapp]);
    }

    public function update(Webapp $webapp, WebappRequest $request){ //colocar no webappcontroller?
        $validated = $request->validated();
        $webapp['status'] = "Solicitado";

        if($validated['tipo'] == 'outro_app'){
            $repo_version = new ApiService;
            if($repo_version->api($request->url_github)['ok'] == false){
                return redirect("/edit/$webapp->id")
                ->withInput($validated)
                ->withErrors(['repo' => 'O repositório não foi encontrado ou está indisponível. Verifique o campo novamente.']);
            }
            $validated['version'] = $repo_version->api($request->url_github)['content'];
        }

        $webapp->update($validated);
        
        $moderation = new Moderation();
        $moderation->webapp_id = $webapp->id;
        $moderation->user_id = $webapp->user_id;
        $moderation->save();

       session()->flash('alert-success','Seu pedido foi alterado. Aguardando revisão de um administrador');
       return redirect('/minhas-solicitacoes');
    }
}
