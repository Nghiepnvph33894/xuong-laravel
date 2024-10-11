<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Expense;
use App\Models\FinancialReport;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Subject;
use App\Models\Taxe;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Classroom::create([
                'name'        => 'phòng '.$i,
                'teacher_name'=> fake()->name,
            ]);

            Subject::create([
                'name'    =>fake()->name,
                'credits' =>rand(0,9),
            ]);
        }


        // \App\Models\User::factory(100)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // 1. Insert Products
        // Product::insert([
        //     [
        //         'name' => 'Bàn gỗ',
        //         'price' => 2000000,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ],
        //     [
        //         'name' => 'Ghế xoay',
        //         'price' => 1500000,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        //     [
        //         'name' => 'Tủ quần áo',
        //         'price' => 5000000,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        //     [
        //         'name' => 'Giường ngủ',
        //         'price' => 8000000,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        // ]);

        // // 2. Insert Sales
        // Sale::insert([
        //     [
        //         'product_id' => 1,
        //         'quantity' => 2,
        //         'price' => 2000000,
        //         'total' => 4000000,
        //         'sale_date' => '2024-09-15',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        //     [
        //         'product_id' => 2,
        //         'quantity' => 5,
        //         'price' => 1500000,
        //         'total' => 7500000,
        //         'sale_date' => '2024-09-16',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        //     [
        //         'product_id' => 3,
        //         'quantity' => 1,
        //         'price' => 5000000,
        //         'total' => 5000000,
        //         'sale_date' => '2024-09-17',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        //     [
        //         'product_id' => 4,
        //         'quantity' => 2,
        //         'price' => 8000000,
        //         'total' => 16000000,
        //         'sale_date' => '2024-09-18',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        // ]);

        // // 3. Insert Expenses
        // Expense::insert([
        //     [
        //         'description' => 'Nhập hàng tháng 9',
        //         'amount' => 8500000,
        //         'expense_date' => '2024-09-05',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        //     [
        //         'description' => 'Chi phí vận chuyển',
        //         'amount' => 500000,
        //         'expense_date' => '2024-09-10',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        //     [
        //         'description' => 'Bảo hành sản phẩm',
        //         'amount' => 2000000,
        //         'expense_date' => '2024-09-12',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        //     [
        //         'description' => 'Lương nhân viên tháng 9',
        //         'amount' => 15000000,
        //         'expense_date' => '2024-09-15',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        // ]);

        // // 4. Insert Financial Reports
        // FinancialReport::insert([
        //     [
        //         'month' => 9,
        //         'year' => 2024,
        //         'total_sales' => 32000000,
        //         'total_expenses' => 18200000,
        //         'profit_before_tax' => 13800000,
        //         'tax_amount' => 1380000,
        //         'profit_after_tax' => 12420000,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        // ]);

        // // 5. Insert Taxes
        // Taxe::insert([
        //     [
        //         'tax_name' => 'VAT',
        //         'rate' => 10,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()

        //     ],
        // ]);
    }
}
