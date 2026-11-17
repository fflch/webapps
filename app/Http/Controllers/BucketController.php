<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBucketRequest;
use App\Models\Bucket;
use App\Models\Webapp;
use App\Services\BucketService;
use Illuminate\Http\Request;

class BucketController extends Controller
{
    public function index()
    {

    }

    public function store(CreateBucketRequest $request)
    {
        $requestData = $request->validated();
        $bucketInfo = (new BucketService())->provisionBucketWithCredentials($requestData['app_name'], true);

        Bucket::create(
            [
                'app_id' => $requestData['app_id'],
                'name' => $bucketInfo['bucket_name'],
                'key_id' => $bucketInfo['access_key_id'],
                'key_secret' => $bucketInfo['secret_access_key'],
                'key_name' => $bucketInfo['bucket_name']
            ]
        );

        return redirect("/webapps/{$requestData['app_id']}/");
    }

    public function update()
    {

    }

    public function test_connection()
    {
        
    }
}
