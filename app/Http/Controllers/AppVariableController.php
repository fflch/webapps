<?php

namespace App\Http\Controllers;

use App\Models\AppVariable;
use App\Models\Webapp;
use App\Http\Requests\UpdateAppVariableRequest;

class AppVariableController extends Controller
{
    public function show(Webapp $webapp)
    {
        $webapp->load('appVariables.imageVariable');

        return view('webapps.editvariables', [
            'webapp' => $webapp,
        ]);
    }

    public function update(AppVariable $appVariable, UpdateAppVariableRequest $request)
    {
        $appVariable->update($request->validated());

        return back()->with('alert-success', 'Variável salva com sucesso.');
    }
}
