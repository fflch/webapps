<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class AddDominioAction
{
    public function execute(array $validated): array
    {
        $validated['dominio'] = $validated['name'] . 'fflch.usp.br';
        $validated['user_id'] = Auth::id();

        return $validated;
    }
}
