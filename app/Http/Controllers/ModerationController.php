<?php

namespace App\Http\Controllers;

use App\Models\Moderation;
use App\Models\Webapp;
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    public function index(){
        $moderations = Moderation::join('webapps','webapps.id','moderations.webapp_id')->where('webapps.status','Solicitado')->get();
        return view('moderation', ['moderations' => $moderations]);
    }

    public function aprovar(Webapp $webapp){
        return view('aprovar_solicitacao', ['webapp' => $webapp]);
    }

    public function update(Request $request, Webapp $webapp){
        //$request->all();
        $webapp->update();
        return redirect('/');
    }

}
