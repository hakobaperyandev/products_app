<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use SplTempFileObject;

class ExportProductsWithCSV implements ShouldQueue
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
        $fileName = 'products_export_' . now()->timestamp . '.csv';
        $filePath = "exports/{$fileName}";
        
        $csv = Writer::createFromPath(Storage::disk('public')->path($filePath), 'w+');

        $csv->insertOne(['ID', 'Title', 'Price', 'Quantity']);
        
        Product::chunk(1000, function ($products) use ($csv) {
            foreach ($products as $product) {
                $csv->insertOne([$product->id, $product->title, $product->price, $product->quantity]);
            }
        });
        Storage::disk('public')->put("exports/{$fileName}", $csv->toString());
    }
}
