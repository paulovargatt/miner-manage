<?php

use Illuminate\Database\Seeder;
use App\Clientes;
class ClienteSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCliente();
    }

    private function createCliente()
    {
        Clientes::create([
            'name' => 'Paulo',
            'coin_id'  => '1',
            'power_miner'  => '10.8',
            'balance' => '0.000000',
            'desc' => 'Teste Cliente',
            'date_plan' => '2020-01-01 00:00:00'
        ]);

        $this->command->info('Cliente Foi');
    }
}
