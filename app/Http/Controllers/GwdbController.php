<?php

namespace App\Http\Controllers;

use App\Models\AppDatabase;
use App\Services\GwmariadbService;
use App\Services\AppDatabaseService;
use Illuminate\Support\Facades\Http;
use App\Models\Webapp;

class GwdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = (new GwmariadbService())->listarDatabase();

        dd($response);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Webapp $webapp)
    {
        /* dump('gw-store', $webapp); */
        $siteName = $webapp->name;
        $appId = $webapp->id;

        $response = (new GwmariadbService($siteName))->storeDatabase();
        if ($response == false) {
            return redirect("/webapps/{$appId}");
        }
        $appDatabase = (new AppDatabaseService())->storeDatabaseData($webapp, $response['senha']);
        return redirect("/webapps/{$appId}");
    }

    /**
     * Display the specified resource.
     */
    public function show(AppDatabase $appdatabase)
    {
        return view('gwmariadb.show', [
            'database' => $appdatabase
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $appId)
    {

        return view('gwmariadb.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppDatabase $appdatabase)
    {
        $webapp = $appdatabase->App;
        $siteName = $webapp->name;

        $response = (new GwmariadbService($siteName))->trocarSenhaUsuario();

        (new AppDatabaseService())->updateDatabasePassword($appdatabase, $response['senha']);

        return redirect("/gwdb/{$appdatabase->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function test_connection()
    {
        $response = Http::withHeaders([
            'X-Token' => env('GWMARIADB_TOKEN'),
        ])->get(env('GWMARIADB_URL'));
        dd(json_encode($response->json()));

        return json_encode($response->json());
    }
}
