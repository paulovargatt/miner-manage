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
                <span class="info-box-number balance_ls">{{$cliente->balance}} Eth</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-tasks"></i></span>
            <div class="info-box-content ">
                <span class="info-box-text">Poder de Mineração</span>
                <span class="info-box-number minerpower">{{$cliente->power_miner}} {{$cliente->coin_name == 'Ethereum' ? 'MH/s' : ''}}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-navy"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Plano</span>
                <span class="info-box-number">
                    <select id="plan" style="border: 0px;">
                        @foreach($coin as $coins)
                         <option id="{{$coins->id}}" {{$coins->id == $cliente->coin_id ? 'selected' : ''}}>{{$coins->name}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Data da Contratação</span>
                <span class="info-box-number">{{$cliente->date_plan->diffForHumans() .'  '. $cliente->date_plan->format('d/m/Y')}}</span>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="container">
        <div class="nav-tabs-custom" style="width: 97%">
            <ul class="nav nav-tabs">
                <li><h4 style="margin: 10px 71px;"><b>{{$cliente->name}}</b></h4></li>
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Movimentações</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Editar Dados</a></li>
                <li style="width: 240px;margin: -8px;">
                    <div class="input-group margin">
                        <input type="text" id="balance" class="form-control" value="0.000000">
                        <span class="input-group-btn">
                      <button type="button" class="btn btn-success btn-flat" id="plus-saldo">Aumentar Saldo </button>
                    </span>
                    </div>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <b>Movimentações</b>

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <b>Editar</b>
                </div>
            </div>
        </div>
</div>


@stop


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>

    <script>

    $('#balance').mask('0.000000');

    $('.content-header').on('change', function () {
        var plan = $('#plan option:selected').attr('id');
        $.ajax({
            url: 'update-cliente/{{$cliente->id}}',
            method: "POST",
            dataType: "JSON",
            data:{
              "_token": "{{ csrf_token() }}",
              "plan" : plan
            },
            beforeSend: function () {
                $('#loader').fadeIn();
            },
            complete: function () {
                $('#loader').fadeOut();
                $('.minerpower').load(' .minerpower');
            }
        });
    });


    $(document).on('click','#plus-saldo', function () {
        var balance = $('#balance').val();
        $.ajax({
            url: 'update-saldo-cliente/{{$cliente->id}}',
            method: "POST",
            dataType: "JSON",
            data:{
                "_token": "{{ csrf_token() }}",
                "balance" : balance
            },
            beforeSend: function () {
                $('#loader').fadeIn();
            },
            complete: function () {
                $('#loader').fadeOut();
                $('.balance_ls').load(' .balance_ls');
            }
        });

    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection