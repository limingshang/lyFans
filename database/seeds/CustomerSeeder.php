<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('customer')->insert([
            ['username' => '1'],
            ['username' => '2'],
            ['username' => '3']
        ]);
    }
}
