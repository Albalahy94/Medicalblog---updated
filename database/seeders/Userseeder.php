<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
          
        
            [
                'name' => 'said',
                'admin_status' => '1',
                'pending' => '0',
                'email' => 'said2@said2',
                'password'  => bcrypt('01230123'),
            ]
        );
    }
}