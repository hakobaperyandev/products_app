<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateProductJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $productCount = DB::table('products')->count();
        if ($productCount < 1500000) {
            $products = [];
            for ($i = 0; $i < 1000; $i++) {
                $products[] = [
                    'title' => 'Product ' . uniqid(),
                    'price' => rand(10, 500),
                    'quantity' => rand(1, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            Product::insert($products);
            echo "Inserted 1000 new products. Current product count: " . ($productCount + 1000);
        } else {
            echo "No products inserted. The products table already contains 1.5 million or more rows.";
        }
    }
}
