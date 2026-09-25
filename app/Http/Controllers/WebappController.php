<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebappRequest;
use App\Http\Requests\AppUpdateRequest;
use App\Models\Webapp;
use App\Models\AppVariable;
use App\Models\DockerImage;
use App\Actions\AddDominioAction;
use Illuminate\Support\Facades\DB;
use App\Actions\StoreAppVariablesAction;

class WebappController extends Controller
{
    public function __construct(
        protected AddDominioAction $addDominioAction
    ) {}

    public function index()
    {
        return view('webapps.index', [
            'webapps' => Webapp::all()
        ]);
    }

    public function show(Webapp $webapp)
    {
        return view('webapps.show', [
            'webapp' => $webapp
        ]);
    }

    public function create(Webapp $webapp)
    {
        return view('webapps.create', [
            'webapp' => $webapp,
            'docker_images' =>DockerImage::all()
        ]);
    }

    public function edit(Webapp $webapp)
    {
        return view('webapps.edit', [
            'webapp' => $webapp,
            'docker_images' =>DockerImage::all()
        ]);
    }

    public function update(AppUpdateRequest $request, Webapp $webapp)
    {
        $validated = $this->addDominioAction->execute($request->validated());

        DB::transaction(function () use ($webapp, $validated) {

            $webapp->update($validated);

            if ($webapp->wasChanged('image_id')) {
                AppVariable::where('app_id', $webapp->id)->delete();
                StoreAppVariablesAction::execute($webapp);
            }

        });

        return redirect()->route('webapps.show', $webapp)
            ->with('alert-success', 'App atualizado com sucesso.');
    }


    public function store(WebappRequest $request)
    {
        $validated = $this->addDominioAction->execute($request->validated());

        $webapp = DB::transaction(function () use ($validated) {
            $webapp =  Webapp::create($validated);

            StoreAppVariablesAction::execute($webapp);

            return $webapp;
        });

        return redirect()->route('webapps.show', $webapp)
            ->with('alert-success', 'App criado com sucesso.');
    }

}
