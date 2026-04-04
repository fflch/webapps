<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebappRequest;
use App\Models\Moderation;
use App\Models\Webapp;
use App\Http\Services\ApiService;
use Illuminate\Http\Client\RequestException;

class WebappController extends Controller
{
    public function index(){
        return view('index');
    }
    
    public function create(Webapp $webapp){
        return view('create', ['webapp' => $webapp]);
    }
    public function store(WebappRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;

        if($validated['tipo'] == 'outro_app'){
            $repo_version = new ApiService;
            if($repo_version->api($request->url_github)['ok'] == false){
                return redirect('/create')
                ->withInput($validated)
                ->withErrors(['repo' => 'O repositório não foi encontrado ou está indisponível. Verifique o campo novamente.']);
            }
            $validated['version'] = $repo_version->api($request->url_github)['content'];
        }

        $webapp = Webapp::create($validated);

        $moderation = new Moderation();
        $moderation->webapp_id = $webapp->id;
        $moderation->user_id = $webapp->user_id;
        $moderation->save();
        session()->flash('alert-success','Solicitação enviada com sucesso. Aguarde a análise de um administrador');
        return redirect('/');
    }
}
