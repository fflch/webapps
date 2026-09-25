@extends('main')
@section('content')
    <div class="card shadow-sm">
        <div class="card-header fw-bold"><b>Solicitação</b></div>
        <div class="card-body">
          <form method="post" action="{{ route('webapps.store') }}">
                @csrf
                @include('webapps.partials.form')
            </form>
        </div>
    </div>
@endsection
