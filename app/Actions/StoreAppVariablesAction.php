<?php

namespace App\Actions;

use App\Models\AppVariable;
use App\Models\ImageVariable;
use App\Models\Webapp;

class StoreAppVariablesAction
{

    public static function execute(Webapp $webapp)
    {
        $variables = ImageVariable::select('id')
            ->where('image_id', $webapp->image_id)
            ->toBase()
            ->get()
            ->map(function($item) use($webapp)  {
                return [
                    'image_variable_id' => $item->id,
                    'app_id' => $webapp->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            })->toArray();

        AppVariable::insert($variables);
    }

}
