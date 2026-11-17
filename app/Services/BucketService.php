<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class BucketService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    private function client(): PendingRequest
    {
        return Http::baseUrl(config('webapps.s3_api_url'))
            ->withToken(config('webapps.s3_token'))
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
    public function provisionBucketWithCredentials(string $bucketName, bool $isOwner = false): array
    {

        $bucketId = $this->createBucket($bucketName);

        $keyResponse = $this->createKey($bucketName);
        $accessKeyId = $keyResponse['access_key_id'];
        $secretAccessKey = $keyResponse['secret_access_key'];

        $this->giveKeyBucketPermission($bucketId, $accessKeyId, $isOwner);

        return [
            'bucket_id' => $bucketId,
            'bucket_name' => $bucketName,
            'access_key_id' => $accessKeyId,
            'secret_access_key' => $secretAccessKey,
        ];
    }


}
