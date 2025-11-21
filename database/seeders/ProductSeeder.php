<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Notebook Dell',
                'description' => 'Notebook Dell i5 8GB RAM',
                'price' => 2999.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mouse Logitech',
                'description' => 'Mouse sem fio',
                'price' => 199.90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teclado Mecânico',
                'description' => 'Teclado RGB switches blue',
                'price' => 450.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}