@extends('adminlte::page')

@section('title', 'Cadastrar Cliente')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10 col-md-offset-1">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Novo Cliente</h3>
                    </div>
                    <div class="box-body">
                        <form action="/cliente/post-form-new-client" method="post">
                            {{csrf_field()}}
                            <input class="form-control" required name="name" type="text" placeholder="Nome Do Cliente">
                            <br>
                            <select class="form-control" name="select">
                                @foreach($coin as $moeda)
                                <option value="{{$moeda->id}}">{{$moeda->name}}</option>
                                    @endforeach
                            </select>
                            <br>
                            <textarea class="form-control" name="desc" placeholder="Informações Adicionais"></textarea>
                            <br>
                            <input class="form-control" required name="power" type="number" placeholder="Poder de mineração">
                            <br>
                            <button class="btn btn-success">Salvar Cliente</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
