<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('customers', CustomerController::class);
Route::delete('customers/{customer}/forceDestroy', [CustomerController::class, 'forceDestroy'])
    ->name('customers.forceDestroy');

Route::resource('employees', EmployeeController::class);

// Route::get('/', function () {
//     $query1 = DB::table('sales')
//         ->selectRaw('SUM(total) as total_sales')
//         ->selectRaw('EXTRACT(MONTH FROM sale_date) as month')
//         ->selectRaw('EXTRACT(YEAR FROM sale_date) as year')
//         ->groupBy(DB::raw('EXTRACT(MONTH FROM sale_date), EXTRACT(YEAR FROM sale_date)'))
//         ->get();
        
//     $query2 = Expense::selectRaw('SUM(amount) as total_expenses')
//         ->selectRaw('EXTRACT(MONTH FROM expense_date) as month')
//         ->selectRaw('EXTRACT(YEAR FROM expense_date) as year')
//         ->groupBy(DB::raw('EXTRACT(MONTH FROM expense_date), EXTRACT(YEAR FROM expense_date)'))
//         ->get();


//     dd($query1, $query2);
// });

// Route::get('/insert', function () {

//     $total_sales = DB::table('sales')
//         ->whereMonth('sale_date', 9)
//         ->whereYear('sale_date', 2024)
//         ->sum('total');

//     $total_expenses = DB::table('expenses')
//         ->whereMonth('expense_date', 9)
//         ->whereYear('expense_date', 2024)
//         ->sum('amount');

//     $profit_before_tax = $total_sales - $total_expenses;

//     $tax_rate = DB::table('taxes')
//         ->where('tax_name', 'VAT')
//         ->value('rate');

//     $tax_amount = $total_sales * ($tax_rate / 100);

//     $profit_after_tax = $profit_before_tax - $tax_amount;

//     DB::table('financial_reports')->insert([
//         'month' => 9,
//         'year' => 2024,
//         'total_sales' => $total_sales,
//         'total_expenses' => $total_expenses,
//         'profit_before_tax' => $profit_before_tax,
//         'tax_amount' => $tax_amount,
//         'profit_after_tax' => $profit_after_tax,
//         'created_at' => now(),
//         'updated_at' => now(),
//     ]);

//     return 'Thêm thành công!!!';
// });

// Route::get('/', function () {

//     $query1 = DB::table('user', 'u')
//         ->join('orders AS o', 'i.id', 'o.user_id')
//         ->selectRaw('u.name, SUM(o.amount) AS total_spent')
//         ->groupBy('u.name')
//         ->having('total_spent', '>', 1000)
//         ->toRawSql();

//     $query2 = DB::table('orders')
//         ->selectRaw('DATE(order_date) AS date, COUNT(*) AS orders_count, SUM(total_amount) AS total')
//         ->whereBetween('order_date', ['2024-01-01', '2024-09-30'])
//         ->groupByRaw('DATE(order_date)')
//         ->toRawSql();

//     $query3 = DB::table('products', 'p')
//         ->select('products_name')
//         ->whereNotExists(function ($query) {
//             $query->selectRaw('1')
//                 ->from('orders as o')
//                 ->where('o.product_id', 'p.id');
//         })
//         ->toRawSql();

//     $query4 = DB::table('products', 'p')
//         ->select(
//             DB::raw('WITH sales_cte AS (SELECT product_id, SUM(quantity) AS total_sold FROM sales GROUP BY product_id)'),
//             'p.product_name',
//             's.total_sold',
//         )
//         ->join('sales_cte s', 'p.id', 's.product_id')
//         ->where('s.total_sold', '>', '100')
//         ->toRawSql();

//     $query5 = DB::table('users')
//         ->select('users.name', 'products.product_name', 'orders.order_date')
//         ->join('orders', 'users.id', 'orders.user_id')
//         ->join('order_items', 'orders.id', 'order_items.order_id')
//         ->join('products', 'order_items.product_id', 'products.id')
//         ->where('orders.order_date', '>=', DB::raw('NOW() - INTERVAL 30 DAY'))
//         ->toRawSql();

//     $query6 = DB::table('orders')
//         ->selectRaw("DATE_FORMAT(orders.order_date, '%Y-%M') AS order_month, SUM(order_items.quantity * order_items.price) AS total_revenue")
//         ->join('order_items', 'orders.id', 'order_items.order_id')
//         ->where('orders.status', 'completed')
//         ->groupBy('order_month')
//         ->orderBy('order_month', 'DESC')
//         ->toRawSql();

//     $query7 = DB::table('products')
//         ->select('products.product_name')
//         ->leftJoin('order', 'products.id', 'order_items.product_id')
//         ->whereNull('order_items.product_id')
//         ->toRawSql();

//     $query8 = DB::table('products', 'p')
//         ->selectRaw("p.category_id, p.product_name, MAX(oi.total) AS max_revenue")
//         ->join(DB::raw('(SELECT product_id, SUM(quantity * price) AS total FROM order_items GROUP BY product_id) as oi'), 'p.id', 'oi.product_id')
//         ->groupBy('p.category_id', 'p.product_name')
//         ->orderBy('max_revenue', 'DESC')
//         ->toRawSql();

//     $query9 = DB::table('orders')
//         ->selectRaw("orders.id, users.name, orders.order_date, SUM(order_items.quantity * order_items.price) as total_value")
//         ->join('users', 'users.id', 'orders.order_id')
//         ->join('order_items', 'orders.id', 'order_items.order_id')
//         ->groupBy('orders.id', 'users.name', 'orders.order_date')
//         ->havingRaw("total_value > (select AVG(total) FROM (SELECT SUM(quantity * price) AS total FROM order_items GROUP BY order_id) AS avg_order_value)")
//         ->toRawSql();

//     $query10 = DB::table('products', 'p')
//         ->selectRaw("p.category_id, p.product_name, SUM(oi.quantity) AS total_sold")
//         ->join('order_items', 'p.id', 'oi.product_id')
//         ->groupBy('p.category_id', 'p.product_name')
//         ->havingRaw("total = (SELECT MAX(sub.total_sold) FROM(SELECT product_name, SUM(quantity) AS total_sold FROM order_items JOIN products ON order_items.product_id = product.id WHERE products.category_id = p.category_id GROUP BY product_name )sub ")
//         ->toRawSql();



//     dd(
//         $query1,
//         $query2,
//         $query3,
//         $query4,
//         $query5,
//         $query6,
//         $query7,
//         $query8,
//         $query9,
//         $query10,
//     );
// });
