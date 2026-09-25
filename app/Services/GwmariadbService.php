<?php

namespace App\Services;

use App\Actions\GetGwmariadbPayload;
use App\Actions\SendGwmariadbRequest;

class GwmariadbService
{

    protected string $siteName;

    function __construct(string $siteName = '')
    {
        $this->siteName = $siteName;
    }

    public function listarDatabase()
    {
        $payload = GetGwmariadbPayload::execute('listar_databases');
        return SendGwmariadbRequest::execute($payload)->json();
        /* $response = SendGwmariadbRequest::execute($payload); */
        /* return $response->json(); */
    }

    public function listarUsuarios()
    {
        $payload = GetGwmariadbPayload::execute('listar_usuarios');
        return SendGwmariadbRequest::execute($payload)->json();
        /* $response = SendGwmariadbRequest::execute($payload); */
        /* return $response; */
    }

    public function storeDatabase()
    {
        $userExists = $this->userExists();
        $databaseExists = $this->databaseExists();

        if (!$userExists && !$databaseExists) {
            return $this->criarDatabaseUsuarioPrivilegio();
        }

        if (!$userExists && $databaseExists) {
            $response = $this->criarUsuario();
            $this->concederPrivilegios();
            return $response;
        }

        if ($userExists && !$databaseExists) {
            $response = $this->criarDatabase();
            $this->concederPrivilegios();
            return $response;
        }

        return false;
    }

    public function criarDatabase()
    {
        $payload = GetGwmariadbPayload::execute('criar_database', $this->siteName);
        dd($payload);
        return SendGwmariadbRequest::execute($payload);
    }

    public function trocarSenhaUsuario()
    {
        $payload = GetGwmariadbPayload::execute('trocar_senha', $this->siteName);
        return SendGwmariadbRequest::execute($payload);
    }

    public function criarUsuario()
    {
        $payload = GetGwmariadbPayload::execute('criar_usuario', $this->siteName);
        return SendGwmariadbRequest::execute($payload);
    }

    public function criarDatabaseUsuario()
    {
        $payload = GetGwmariadbPayload::execute('criar_database_usuario', $this->siteName);
        dd($payload);
        return SendGwmariadbRequest::execute($payload);
    }

    public function criarDatabaseUsuarioPrivilegio()
    {
        $payload = GetGwmariadbPayload::execute('criar_database_usuario_privilegio', $this->siteName);
        return SendGwmariadbRequest::execute($payload);
    }

    public function concederPrivilegios()
    {
        $payload = GetGwmariadbPayload::execute('conceder_privilegios', $this->siteName);
        return SendGwmariadbRequest::execute($payload);
    }

    protected function databaseExists()
    {
        $payload = GetGwmariadbPayload::execute('database_existe', $this->siteName);
        $response = SendGwmariadbRequest::execute($payload);
        /* return $response['existe']; */
        return (bool) ($response->json('existe') ?? false);
    }

    protected function userExists()
    {
        $payload = GetGwmariadbPayload::execute('usuario_existe', $this->siteName);
        dump($payload);
        $response = SendGwmariadbRequest::execute($payload);
        dd($response);

        /* return $response['existe']; */

        return (bool) ($response->json('existe') ?? false);
    }
}
