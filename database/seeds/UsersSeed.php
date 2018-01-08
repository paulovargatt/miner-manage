<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        $this->createUser();
    }

    private function createUser()
     {
         User::create([
             'email' => 'pvargatt@gmail.com',
             'name'  => 'Paulo',
             'password' => bcrypt('123456'),
         ]);

         $this->command->info('pvargatt@gmail.com');
     }


}
