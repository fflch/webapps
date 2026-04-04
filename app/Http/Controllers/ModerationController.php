<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModerationRequest;
use App\Models\Moderation;
use App\Models\Webapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ModerationController extends Controller
{
    public function index(){
        Gate::authorize('admins', auth()->user());
        $webapps = Moderation::join('webapps','webapps.id','moderations.webapp_id')
        ->where('webapps.status','Solicitado')
        ->get();
        return view('moderation', ['webapps' => $webapps]);
    }

    public function aprovar(Webapp $webapp){
        Gate::authorize('admins', auth()->user());
        return view('aprovar_solicitacao', ['webapp' => $webapp]);
    }

    public function update(ModerationRequest $request, Webapp $webapp){
        Gate::authorize('admins', auth()->user());
        $validated = $request->validated();
        $webapp['status'] = 'Aprovado';
        $webapp->update($validated);
        session()->flash('alert-success', 'Sistema aprovado');
        return redirect('/');
    }

    public function reprovar(Webapp $webapp){
        Gate::authorize('admins', auth()->user());
        $webapp['status'] = "Negado";
        $webapp->update();
        session()->flash('alert-warning','O pedido foi negado e retornado ao usuário');
        return redirect('/');
    }

}
