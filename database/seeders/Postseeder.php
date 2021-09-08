<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class Postseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('posts')->insert(
            [
                [
                    'name' => 'said said',
                    'description' => 'said said said said',
                    'tag' => 'said said',
                    'category' => 'said said',
                    'file' => '1630954887.png',
                    'user_id' => '1',

                ],
                [
                    'name' => 'said said',
                    'description' => 'said said said said',
                    'tag' => 'said said',
                    'category' => 'said said',
                    'file' => '1630954887.png',
                    'user_id' => '1',
                ],
                [
                    'name' => 'said said',
                    'description' => 'said said said said',
                    'tag' => 'said said',
                    'category' => 'said said',
                    'file' => '1630954887.png',
                    'user_id' => '1',

                ]
            ]
        );
    }
}