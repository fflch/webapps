<?php

namespace App\Http\Controllers;

use App\Models\Moderation;
use Illuminate\Http\Request;

class SolicitacaoController extends Controller
{
    public function index(){
        //$moderation = Moderation::join('webapps','webapps.id','moderations.webapp_id')->where('webapps.status','Solicitado')->get();
        //return view('moderation', ['moderation' => $moderation]);
    }
}
