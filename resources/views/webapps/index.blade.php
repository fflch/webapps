@extends('laravel-usp-theme::master')
@section("content")
<div class="card">
    <div class="card-header"><h3>Apps</h3></div>
    <div class="card-body">
        <div class="row">
            <ul>
                @foreach ($webapps as $webapp)
                    <li><a href="/webapps/{{ $webapp->id }}">{{ $webapp->dominio }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
</div>

@endsection