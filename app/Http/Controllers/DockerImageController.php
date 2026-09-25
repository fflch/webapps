<?php

namespace App\Http\Controllers;

use App\Http\Requests\DockerImageRequest;
use App\Http\Requests\DockerImageUpdateRequest;
use App\Models\DockerImage;

class DockerImageController extends Controller
{

    public function index()
    {
        return view('dockerimages.index', [
            'docker_images' => DockerImage::all()
        ]);
    }

    public function show(DockerImage $dockerimage)
    {
        return view('dockerimages.show', [
            'docker_image' => $dockerimage
        ]);
    }

    public function create()
    {
        return view('dockerimages.create');
    }

    public function store(DockerImageRequest $request)
    {
        $dockerImage = DockerImage::create($request->validated());
        return redirect()->route('dockerimages.show', $dockerImage);
    }

    public function edit(DockerImage $dockerimage)
    {
        return view('dockerimages.edit', [
            'docker_image' => $dockerimage
        ]);
    }

    public function update(DockerImageUpdateRequest $request, DockerImage $dockerimage)
    {
        $dockerimage->update($request->validated());
        return redirect()->route('dockerimages.show', $dockerimage)
            ->with('alert-success', 'Imagem atualizada.');
    }

    public function destroy(DockerImage $dockerimage)
    {
        try {
            $dockerimage->delete();
            return redirect()->route('dockerimages.index')
                             ->with('alert-success', 'Imagem excluída.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Erro específico de banco de dados (como chave estrangeira)
            return back()->with('alert-danger', 'Não é possível excluir esta imagem pois ela possui variáveis vinculadas.');
        } catch (\Exception $e) {
            return back()->withErrors('alert-danger','Falha ao excluir a imagem.');
        }
    }

}
