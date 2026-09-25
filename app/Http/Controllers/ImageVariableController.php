<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageVariableRequest;
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
        $imageId = $imageVariable->image_id;
        $imageVariable->delete();

        return redirect()->route('dockerimages.show', $imageId);
    }

}
