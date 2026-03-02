<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
{
 
   $designers = User::with('shop')
    ->withCount('listings')
    ->where('role', 'designer')
    ->where('is_active', 1)
    ->orderByDesc('listings_count')
    ->take(10)
    ->get()
    ->map(function($designer) {
        $designer->avatar_url = $designer->avatar_url 
            ? asset('storage/home/' . $designer->avatar_url) 
            : asset('adminAssets/images/default-avatar.png');
        return $designer;
    });


    $categories = Category::all()->map(function($category) {
        $category->Image = $category->Image 
            ? asset('storage/'. $category->Image) 
            : asset('adminAssets/images/default-avatar.png');
        return $category;
    });

    return view('home.index', compact('designers','categories'));
}

public function nav(){
    $popularCategories = Category::where('categories.is_active', 1)
    ->whereNull('parent_id')
    ->withCount(['listings' => function ($query) {
        $query->where('product_listings.is_active', 1);
    }])
    ->orderByDesc('listings_count')
    ->take(10)
    ->get();

    return view('home.homeLayout', compact('popularCategories'));
}
}
