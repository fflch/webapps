<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\Webapp;
use App\Services\BucketService;
use Throwable;

class BucketController extends Controller
{

    public function store(Webapp $webapp, BucketService $bucketService)
    {
        try {
            $bucketInfo = $bucketService->provisionBucket($webapp->name, true);
        } catch (Throwable $e) {
            return back()->with('alert-danger', 'Erro ao criar o bucket no servidor S3. Erro:' . $e->getMessage());
        }

        try {
            Bucket::create(
                [
                    'app_id' => $webapp->id,
                    'bucket_id' => $bucketInfo['bucket_id'],
                    'bucket_name' => $bucketInfo['bucket_name'],
                    'key_id' => $bucketInfo['access_key_id'],
                    'key_secret' => $bucketInfo['secret_access_key'],
                ]
            );
        } catch (Throwable $e) {
            $bucketService->deleteBucket($bucketInfo['bucket_name'], $bucketInfo['access_key_id']); // se existir
            return back()->with('alert-danger', 'Erro ao salvar o bucket na base do sistema. Verifique Bucket/Key orfão no servidor S3.' . $e->getMessage());
        }

        return redirect("/webapps/{$webapp->id}/");
    }

}
