<div class="col-md-12">
    <div class="box-body" style="background: #fff">
        <div class="row">
            <div class="col-md-3">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-user-times"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clientes em atraso</span>
                        <span class="info-box-number">{{$clientesEmAtraso->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Valor Total Devido:</span>
                        <span class="info-box-number">R$: {{$devido}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total clientes:</span>
                        <span class="info-box-number">{{$totalClientes->count()}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total das parcelas:</span>
                        <span class="info-box-number">R$: {{$valorTotal}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>

        <h3 class="text-center">TOP #10 Calots</h3>
        <div class="col-md-8">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin text-left" style="font-size: 1.2em">
                        <thead>
                        <tr>
                            <th class="text-left">Nome</th>
                            <th class="text-left">Parcela</th>
                            <th class="text-left">Saldo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tableList as $topDevs)
                            <tr>
                                <td><a href="/cliente/{{$topDevs->id}}">{{$topDevs->name}}</a></td>
                                <td><span class="label label-primary">{{$topDevs->power_miner}}</span></td>
                                <td>
                                    <span class="label {{$topDevs->balance < 0 ? 'label-danger' : 'label-success'}}">{{number_format($topDevs->balance,2, ',', '.')}}</span>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>