<?php

namespace App\Http\Controllers;

use App\Events\ProductUpdatedEvent;
use App\Http\Requests\CreateProductRequest;
use App\Jobs\ExportProductsWithCSV;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
    
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }
    
        $products = $query->orderBy('id', 'DESC')->paginate(20);
    
        return Inertia::render('Dashboard', ['products' => $products]);
    }

    /**
     * 
     */
    public function export()
    {
        ExportProductsWithCSV::dispatch();
        return redirect()->back();
    }

    public function show()
    {
        $files = Storage::disk('public')->files('exports');
        $csvFiles = array_filter($files, function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'csv';
        });

        $fileInfo = array_map(function ($file) {
            return [
                'name'       => basename($file),
                'url'        => Storage::disk('public')->url($file),
                'created_at' => Storage::disk('public')->lastModified($file),
                'size'       => Storage::disk('public')->size($file),
            ];
        }, $csvFiles);

        return Inertia::render('Exports', ['files' => $fileInfo]);
    }
    

    

    
}
