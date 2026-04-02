@extends('laravel-usp-theme::master')
@section('content')
    <div class="card">
        <div class="card-header"><b>Solicitação</b></div>
        <div class="card-body">
            <form method="post" action="/store">
                @method('post')
                @csrf
                @include('partials.form_solicitacao')
            </form>
        </div>
    </div>

@section('javascripts_bottom')
    <script>
        $(document).ready(function() {

            function toggleGithubField() {
                if ($('#button_outro_app').is(':checked')) {
                    $('#url_github').css('display', 'flex');
                } else {
                    $('#url_github').css('display', 'none');
                }
            }

            //executa quando a página carrega
            toggleGithubField();

            //executa quando o usuário muda o radio
            $('input[name="tipo"]').on('change', function() {
                toggleGithubField();
            });

        });
    </script>
@endsection
<style>
    label {
        margin-top: 5px;
        margin-bottom: -15px;
    }
</style>
@endsection
