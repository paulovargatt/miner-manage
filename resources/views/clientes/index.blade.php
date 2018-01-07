@extends('adminlte::page')

@section('title')


@stop

@section('content_header')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-usd"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Saldo</span>
                <span class="info-box-number">{{$cliente->balance}} Eth</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-tasks"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Poder de Mineração</span>
                <span class="info-box-number">{{$cliente->power_miner}} MH/s</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Plano</span>
                <span class="info-box-number">{{$cliente->coin_name}}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Contratado</span>
                <span class="info-box-number">{{$cliente->date_plan->diffForHumans() .'  '. $cliente->date_plan->format('d/m/Y')}}</span>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')

@stop