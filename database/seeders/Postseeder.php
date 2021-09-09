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
                    'name' => 'كستور يا سيادنا',
                    'description' => 'كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور ',
                    'tag' => 'كستور تاج',
                    'category' => 'كستور كاتيجوري ',
                    'file' => '1625806176.png',
                    'user_id' => '1',

                ],
                [
                    'name' => 'كستور يا سيادنا',
                    'description' => 'كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور ',
                    'tag' => 'كستور تاج',
                    'category' => 'كستور كاتيجوري ',
                    'file' => '1625806437.jpg',
                    'user_id' => '2',

                ],
                [
                    'name' => 't-shirt-new',
                    'description' => 't-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new ',
                    'tag' => 't-shirt-2020',
                    'category' => 't-shirt-2020',
                    'file' => '1625810042.jpg',
                    'user_id' => '2',
                ],
                [
                    'name' => 't-shirt-new',
                    'description' => 't-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new ',
                    'tag' => 't-shirt-2020',
                    'category' => 't-shirt-2020',
                    'file' => '1625807683.jpg',
                    'user_id' => '1',
                ],
                [
                    'name' => 'pharma-kheir',
                    'description' => 'pharma-kheir pharma-kheir pharma-kheir pharma-kheir pharma-kheir ',
                    'tag' => 'pharma-kheir',
                    'category' => 'pharma-kheir',
                    'file' => '1630954887.png',
                    'user_id' => '1',

                ],
                [
                    'name' => 'pharma-kheir',
                    'description' => 'pharma-kheir pharma-kheir pharma-kheir pharma-kheir pharma-kheir ',
                    'tag' => 'pharma-kheir',
                    'category' => 'pharma-kheir',
                    'file' => '1630954887.png',
                    'user_id' => '2',
                ],
                [
                    'name' => 'كستور يا سيادنا',
                    'description' => 'كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور ',
                    'tag' => 'كستور تاج',
                    'category' => 'كستور كاتيجوري ',
                    'file' => '1625806176.png',
                    'user_id' => '1',

                ],
                [
                    'name' => 'كستور يا سيادنا',
                    'description' => 'كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور كستور ',
                    'tag' => 'كستور تاج',
                    'category' => 'كستور كاتيجوري ',
                    'file' => '1625806437.jpg',
                    'user_id' => '2',

                ],
                [
                    'name' => 't-shirt-new',
                    'description' => 't-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new ',
                    'tag' => 't-shirt-2020',
                    'category' => 't-shirt-2020',
                    'file' => '1625810042.jpg',
                    'user_id' => '2',
                ],
                [
                    'name' => 't-shirt-new',
                    'description' => 't-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new t-shirt-new ',
                    'tag' => 't-shirt-2020',
                    'category' => 't-shirt-2020',
                    'file' => '1625807683.jpg',
                    'user_id' => '1',
                ],
                [
                    'name' => 'pharma-kheir',
                    'description' => 'pharma-kheir pharma-kheir pharma-kheir pharma-kheir pharma-kheir ',
                    'tag' => 'pharma-kheir',
                    'category' => 'pharma-kheir',
                    'file' => '1630954887.png',
                    'user_id' => '1',

                ],
                [
                    'name' => 'pharma-kheir',
                    'description' => 'pharma-kheir pharma-kheir pharma-kheir pharma-kheir pharma-kheir ',
                    'tag' => 'pharma-kheir',
                    'category' => 'pharma-kheir',
                    'file' => '1630954887.png',
                    'user_id' => '2',
                ]
            ]
        );
    }
}