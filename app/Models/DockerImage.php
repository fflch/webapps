<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DockerImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    protected $fillable = ['name', 'path'];

    public function apps()
    {
        return $this->hasMany(Webapp::class, 'image_id', 'id');
    }

    public function imageVariables()
    {
        return $this->hasMany(ImageVariable::class, 'image_id', 'id');
    }
}
