<?php

namespace App\Console\Commands;

use App\Clientes;
use App\Movimentacao;
use Illuminate\Console\Command;

class MineraEthereumClientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MineraEthereumClientes:miner-eth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Minera ETH para todos os clientes com seu poder atual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $clientes = Clientes::all();
        $url = urldecode("https://whattomine.com/coins/151.json");
        $json = json_decode(file_get_contents($url), true);

        $zcash = urldecode("https://whattomine.com/coins/166.json");
        $jsonCash = json_decode(file_get_contents($zcash), true);

            foreach ($clientes as $calcCliente) {
                if ($calcCliente->coin_id == 1){
                    $netHash = $json['nethash'];
                    $dificult = $json['difficulty'];
                    $dificult24 = $json['difficulty24'];
                    $netHashCalc = ($netHash / $dificult) * $dificult24;
                    $hashPower = ($calcCliente->power_miner * 1e6) / $netHashCalc;
                    $blockTime = $json['block_time'];
                    $blockReward = $json['block_reward24'];
                    $blocksPerMin = 60 / $blockTime;
                    $coinPermine = $blocksPerMin * $blockReward;
                    $ganho = $hashPower * $coinPermine;
                    $ganhoDia = $ganho * 60 * 24;
                    $clienteId = $calcCliente->id;
                    $powerCli = $calcCliente->power_miner;
                    $saldoAnterior = $calcCliente->balance;
                    $newSaldo = number_format($ganhoDia, 6, '.', ',');
                    Movimentacao::mineraCliente($clienteId, $newSaldo, $saldoAnterior, $powerCli);
                    Clientes::updateBalance($clienteId, $newSaldo);
                }elseif ($calcCliente->coin_id == 2) {
                    $netHash = $jsonCash['nethash'];
                    $dificult = $jsonCash['difficulty'];
                    $dificult24 = $jsonCash['difficulty24'];
                    $netHashCalc = ($netHash / $dificult) * $dificult24;
                    $hashPower = ($calcCliente->power_miner * 1) / $netHashCalc;
                    $blockTime = $jsonCash['block_time'];
                    $blockReward = $jsonCash['block_reward24'];
                    $blocksPerMin = 60 / $blockTime;
                    $coinPermine = $blocksPerMin * $blockReward;
                    $ganho = $hashPower * $coinPermine;
                    $ganhoDia = $ganho * 60 * 24;
                    $clienteId = $calcCliente->id;
                    $powerCli = $calcCliente->power_miner;
                    $saldoAnterior = $calcCliente->balance;
                    $newSaldo = number_format($ganhoDia, 6, '.', ',');
                    Movimentacao::mineraCliente($clienteId, $newSaldo, $saldoAnterior, $powerCli);
                    Clientes::updateBalance($clienteId, $newSaldo);
                }else{
                    $clienteId = $calcCliente->id;
                    $powerCli = $calcCliente->power_miner;
                    $saldoAnterior = $calcCliente->balance;
                    $calcSaldo = $powerCli / 30;

                    $newSaldo = number_format($calcSaldo, 4, '.', ',');
                    Movimentacao::mineraCliente($clienteId, $newSaldo, $saldoAnterior, $powerCli);
                    Clientes::updateBalance($clienteId, $newSaldo);
                }

            }

    }
}
