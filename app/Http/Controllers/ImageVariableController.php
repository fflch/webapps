<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageVariableRequest;
use App\Models\DockerImage;
use App\Models\ImageVariable;
use App\Services\VariableService;

class ImageVariableController extends Controller
{
    public function store(StoreImageVariableRequest $request, VariableService $variableService)
    {
        try {
            $variableService->handleVariableStore($request->validated());
            return back();
        } catch (\Throwable $e) {
            return back()->with('alert-danger', 'Erro ao criar a variável. ' . $e->getMessage());
        }
    }

    public function destroy(ImageVariable $imageVariable)
    {
        $image = $imageVariable->image;
        $imageVariable->delete();

        return redirect()->route('dockerimages.variables', $image);
    }
}
