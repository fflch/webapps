<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebappRequest;
use App\Models\Moderation;
use App\Models\Webapp;
use Illuminate\Http\Request;

class WebappController extends Controller
{
    public function index(){
        return view('index');
    }
    
    public function create(Request $request){
        return view('create', ['request' => $request]);
    }
    public function store(WebappRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $webapp = Webapp::create($validated);

        $moderation = new Moderation();
        $moderation->webapp_id = $webapp->id;
        $moderation->user_id = $webapp->user_id;
        $moderation->save();
        session()->flash('alert-success','Solicitação enviada com sucesso. Aguarde a análise de um administrador');
        return redirect('/');
    }
}
