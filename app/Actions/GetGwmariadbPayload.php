<?php

namespace App\Actions;

class GetGwmariadbPayload
{
    public static function execute(string $action, string $siteName = ''): array
    {
        $payload = ['action' => $action];

        if (!empty($siteName)) {
            $payload['nome'] = $siteName;
        }

        return $payload;
    }
}
