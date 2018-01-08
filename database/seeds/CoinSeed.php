<?php

use Illuminate\Database\Seeder;
use App\Moedas;
class CoinSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCoin();
    }

    private function createCoin()
    {
        Moedas::create([
            'name' => 'Ethereum',
        ]);

        Moedas::create([
            'name' => 'Zcash',
        ]);

        $this->command->info('Coins OK');
    }
}
