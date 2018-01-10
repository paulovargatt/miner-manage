<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
             $this->call(UsersSeed::class);
             $this->call(CoinSeed::class);
             $this->call(ClienteSeed::class);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
