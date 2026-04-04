@extends('laravel-usp-theme::master')
@section('content')
    <form method="post" action="/aprovado/{{ $webapp->id }}">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold">
                        Database
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Database Name</label>
                            <input type="text" name="database_name" value="{{ old('database_name',$webapp->database_name) }}" class="form-control" placeholder="ex: my_database">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Database Username</label>
                            <input type="text" name="database_username" value="{{ old('database_username',$webapp->database_username) }}" class="form-control" placeholder="ex: db_user">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Database Password</label>
                            <input type="password" value="{{ old('database_password',$webapp->database_password) }}" name="database_password" class="form-control">
                        </div>

                    </div>
                </div>
            </div>

            <!-- BUCKET -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header fw-bold">
                        Bucket (Storage)
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Bucket Name</label>
                            <input type="text" name="bucket_name" value="{{ old('bucket_name', $webapp->bucket_name) }}" class="form-control" placeholder="ex: my-bucket">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bucket Username</label>
                            <input type="text" name="bucket_username" value="{{ old('bucket_username', $webapp->bucket_username) }}"  class="form-control" placeholder="ex: bucket_user">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bucket Password</label>
                            <input type="password" value="{{ old('bucket_password', $webapp->bucket_password) }}"  name="bucket_password" class="form-control">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" style="margin-top:15px;">
                <button style="width:100%;" type="submit" class="btn btn-success">Aprovar</button>
            </div>
        </div>
    </form>
@endsection
