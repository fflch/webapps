<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    //mudar nome para solicitações?
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
