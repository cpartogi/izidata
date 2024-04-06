<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('balance')->insert([
            'id' => '1',
            'amount_available' => '0',
            'user_id' => '1',
        ]);
        DB::table('balance')->insert([
            'id' => '2',
            'amount_available' => '1',
            'user_id' => '2',
        ]);
        DB::table('balance')->insert([
            'id' => '3',
            'amount_available' => '0',
            'user_id' => '3',
        ]);
        DB::table('balance')->insert([
            'id' => '4',
            'amount_available' => '21',
            'user_id' => '4',
        ]);

        DB::table('transaction')->insert([
            'id' => '1',
            'trx_id' => 'a',
            'user_id' => '1',
            'amount' => '0',
            'created_at' => '2022-03-07 09:55:44',
            'updated_at' => '2022-03-07 09:55:44',
        ]);

        DB::table('transaction')->insert([
            'id' => '2',
            'trx_id' => 'B',
            'user_id' => '1',
            'amount' => '0',
            'created_at' => '2022-03-07 09:55:44',
            'updated_at' => '2022-03-07 09:55:44',
        ]);
    }
}
