@extends('adminlte::page')

@section('title', 'Cadastrar Cliente')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10 col-md-offset-1">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Atualizar Dados</h3>
                    </div>
                    <div class="box-body">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                       <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
                                    </p>
                                @endif
                            @endforeach
                        </div>

                        <form action="/update-senha" method="post">
                            {{csrf_field()}}
                            <input class="form-control" required name="name" type="text" value="{{$user->name}}">
                            <br>
                            <input class="form-control" required name="email" type="email" placeholder="Email"
                                   value="{{$user->email}}">
                            <br>
                            <input class="form-control" name="password" type="password" placeholder="Senha">
                            <br>
                            <button class="btn btn-success">Atualizar Dados</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
