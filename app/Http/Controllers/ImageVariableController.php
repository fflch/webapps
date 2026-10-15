<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageVariableRequest;
use App\Models\DockerImage;
use App\Models\ImageVariable;

class ImageVariableController extends Controller
{
    public function store(StoreImageVariableRequest $request)
    {
        ImageVariable::create($request->validated());
        return back();
    }

    public function destroy(ImageVariable $imageVariable)
    {
        $image = $imageVariable->image;
        $imageVariable->delete();

        return redirect()->route('dockerimages.variables', $image);
    }
}
