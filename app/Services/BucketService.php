<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class BucketService
{
    private function client(): PendingRequest
    {
        return Http::baseUrl(config('webapps.s3_admin_url'))
            ->withToken(config('webapps.s3_admin_token'))
            ->acceptJson()
            ->asJson()
            ->timeout(10);
    }

    private function createBucket(string $bucketName): string
    {
        $bucketResponse = $this->client()
            ->post('/v2/CreateBucket', [
                'globalAlias' => $bucketName,
            ])
            ->throw()
            ->json();

        return $bucketResponse['id'];
    }

     /**
     *
     * @return array{access_key_id: string, secret_access_key: string}
     * @throws RequestException
     */
    private function createKey(string $bucketName): array
    {
        $keyResponse = $this->client()
            ->post('/v2/CreateKey', [
                'name' => $bucketName,
            ])
            ->throw()
            ->json();

        return [
            'access_key_id' => $keyResponse['accessKeyId'],
            'secret_access_key' => $keyResponse['secretAccessKey']
        ];
    }

    private function giveKeyBucketPermission(string $bucketId, string $accessKeyId, bool $isOwner = false)
    {
        $this->client()
            ->post('/v2/AllowBucketKey', [
                'bucketId' => $bucketId,
                'accessKeyId' => $accessKeyId,
                'permissions' => [
                    'read' => true,
                    'write' => true,
                    'owner' => $isOwner,
                ],
            ])
            ->throw();
    }

    /**
     * Provisiona um bucket exclusivo e gera credenciais S3 vinculadas a ele.
     *
     * @return array{bucket_id: string, bucket_name: string, access_key_id: string, secret_access_key: string}
     * @throws RequestException
     */
    public function provisionBucket(string $bucketName, bool $isOwner = false): array
    {
        $bucketId = $this->createBucket($bucketName);

        try {
            $key = $this->createKey($bucketName);
        } catch (\Throwable $e) {
            $this->client()->post("/v2/DeleteBucket?id={$bucketId}");
            throw $e;
        }

        try {
            $this->giveKeyBucketPermission($bucketId, $key['access_key_id'], $isOwner);
        } catch (\Throwable $e) {
            $this->deleteBucket($bucketId, $key['access_key_id']);
            throw $e;
        }

        return [
            'bucket_id'         => $bucketId,
            'bucket_name'       => $bucketName,
            'access_key_id'     => $key['access_key_id'],
            'secret_access_key' => $key['secret_access_key'],
        ];

    }

    public function deleteBucket(string $bucketName, string $accessKeyId): void
    {
        // 1. Descobre o ID interno do bucket a partir do nome (alias global)
        $info = $this->client()
            ->get('/v2/GetBucketInfo', ['globalAlias' => $bucketName])
            ->json();

        $bucketId = $info['id'] ?? throw new RuntimeException("Bucket {$bucketName} não encontrado");

        // 3. Apaga o bucket
        $this->client()->post("/v2/DeleteBucket?id={$bucketId}")->throw();

        // 4. Apaga a chave de acesso associada
        $this->client()->post("/v2/DeleteKey?id={$accessKeyId}")->throw();
    }

}
