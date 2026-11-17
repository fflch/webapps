<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bucket extends Model
{
    protected $fillable = ['app_id', 'name', 'key_id', 'key_secret', 'key_name'];

    public function App()
    {
        return $this->belongsTo(Webapp::class, 'app_id', 'id');
    }
}
