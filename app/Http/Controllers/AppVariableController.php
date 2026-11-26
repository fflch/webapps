<?php

namespace App\Http\Controllers;

use App\Models\AppVariable;
use App\Models\Webapp;
use App\Http\Requests\UpdateAppVariableRequest;
use App\Services\VariableService;

class AppVariableController extends Controller
{
    public function show(Webapp $webapp, VariableService $variableService)
    {
        $webapp->load('appVariables.imageVariable');

        return view('webapps.editvariables', [
            'webapp' => $webapp,
            'hasAllVariables' => $variableService->hasAllVariables($webapp)
        ]);
    }

    public function update(AppVariable $appVariable, UpdateAppVariableRequest $request)
    {
        $appVariable->update($request->validated());

        return back()->with('alert-success', 'Variável salva com sucesso.');
    }

    public function refresh(Webapp $webapp, VariableService $variableService)
    {
        try {     
            $variableService->refreshAppVariables($webapp);
    
            return back()->with('alert-success', 'Variáveis atualizadas com sucesso.');
        } catch (\Throwable $e) {
            return back()->with('alert-danger', 'Houve um erro ao atualizar as variáveis. ' . $e->getMessage());
        }
    }
}
