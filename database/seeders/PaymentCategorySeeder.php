<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PaymentCategory;
use Illuminate\Database\Seeder;

class PaymentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentCategory::insert([
            [
                'name' => 'Multimedia',
                'price' => 150000,
            ],
            [
                'name' => 'Pemasaran',
                'price' => 500000,
            ],
        ]);
    }
}
