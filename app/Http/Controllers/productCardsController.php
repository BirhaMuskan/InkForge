<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductImage;
use App\Models\ProductListing;
use App\Models\ProductReview;
use App\Models\ProductTag;
use App\Models\ProductTagAssignment;
use App\Models\ProductVariant;
use App\Models\ProductView;
use App\Models\DesignTemplate;
use App\Models\UserDesign;
use App\Models\Wishlist;
use App\Models\Shop;

class productCardsController extends Controller
{
        public function cards(Request $request){
         $listings = ProductListing::with([
                'product.images',
                'product.variants',
                'product.category',
                'design'
            ])
            ->where('is_active', 1)
            ->whereHas('product', function ($q) {
                $q->where('is_active', 1);
            });

        // CATEGORY FILTER (multi-select)
if ($request->filled('category')) {

    $categories = is_array($request->category)
        ? $request->category
        : [$request->category];

    $listings->whereHas('product', function ($q) use ($categories) {
        $q->whereIn('category_id', $categories);
    });
}


        // PRICE FILTER
        if ($request->max_price) {
            $listings->where('final_price', '<=', $request->max_price);
        }

        // COLOR FILTER (from product_variants)
        if ($request->color) {
            $listings->whereHas('product.variants', function ($q) use ($request) {
                $q->where('color_hex', $request->color);
            });
        }

        // SORTING
        match ($request->sort) {
            'low'  => $listings->orderBy('final_price', 'asc'),
            'high' => $listings->orderBy('final_price', 'desc'),
            default => $listings->latest(),
        };

        return view('home.prodCards', [
            'listings'   => $listings->paginate(12),
            'categories' => Category::where('is_active', 1)->get(),
            'colors'     => $this->getColors()
        ]);
    }

   private function getColors()
{
    return ProductVariant::whereNotNull('color_hex')
        ->distinct()
        ->pluck('color_hex');
}

     
    
}
