<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ProductTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class adminController extends Controller
{
    
   // Product list page
    // public function Products()
    // {
    //     $products = Product::with([
    //         'category',
    //         'variants',
    //         'images',
    //         'attributes.attribute',
    //         'tags',
    //         'reviews',
    //         'listings'
    //     ])
    //     ->orderBy('created_at', 'desc')
    //     ->get();

    //     // Dashboard stats
    //     $totalProducts = Product::count();
    //     $activeProducts = Product::where('is_active', 1)->count();
    //     $featuredProducts = Product::where('is_featured', 1)->count();
    //     $outOfStock = Product::whereHas('variants', function ($q) {
    //         $q->where('stock_count', '<=', 0);
    //     })->count();

        

    //     return view('admin.products', compact(
    //         'products', 
    //         'totalProducts', 
    //         'activeProducts', 
    //         'featuredProducts', 
    //         'outOfStock',
            
    //     ));
    // }

    public function Products(Request $request)
{
    $query = Product::with(['category','variants','reviews']);

    // ===== APPLY FILTERS =====
    if ($request->filled('status')) {
        $query->where('is_active', $request->status === 'active');
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    if ($request->filled('featured')) {
        $query->where('is_featured', $request->featured === 'yes');
    }

    if ($request->filled('price')) {
        [$min, $max] = array_pad(explode('-', $request->price), 2, null);

        if ($max) {
            $query->whereBetween('base_price', [$min, $max]);
        } else {
            $query->where('base_price', '>=', $min);
        }
    }

    $products = $query->orderBy('created_at','desc')->get();

    // Stats
    $totalProducts = Product::count();
    $activeProducts = Product::where('is_active',1)->count();
    $featuredProducts = Product::where('is_featured',1)->count();
    $outOfStock = Product::whereHas('variants', fn($q)=>$q->where('stock_count','<=',0))->count();

    //  FETCH CATEGORIES
    $categories = Category::orderBy('name')->get();

    return view('admin.products', compact(
        'products',
        'categories',
        'totalProducts',
        'activeProducts',
        'featuredProducts',
        'outOfStock'
    ));
}



    // View / Edit single product
    public function productView($id)
    {
        $product = Product::with([
            'category',
            'variants',
            'images',
            'attributes.attribute',
            'tags',
            'reviews.user',
            'listings.design',
        ])->findOrFail($id);

        return view('admin.productView', compact('product'));
    }


public function destroy($id)
{
    DB::transaction(function () use ($id) {
        $product = Product::findOrFail($id);
        $product->delete();
    });

    return redirect()
        ->route('products')
        ->with('success', 'Product deleted successfully.');
}

    
   public function showAddProd(){
    $categories = Category::all();
    $attributes = ProductAttribute::all();
    $tags = ProductTag::all();


    return view('admin.addProd',compact('categories','attributes','tags'));
   }


    public function store(Request $request)
    {
        $validated = $request->validate([
    // ================= PRODUCTS =================
    'name' => ['required', 'string', 'max:200'],
    'slug' => ['nullable', 'string', 'max:200'],
    'category_id' => ['required', 'exists:categories,id'],
    'base_price' => ['required', 'numeric', 'min:0'],
    'short_description' => ['nullable', 'string', 'max:500'],
    'description' => ['nullable', 'string'],
    'weight_grams' => ['nullable', 'integer', 'min:0'],
    'print_area_width' => ['nullable', 'integer', 'min:0'],
    'print_area_height' => ['nullable', 'integer', 'min:0'],
    'min_dpi' => ['nullable', 'integer', 'min:72'],
    'mockup_template' => ['nullable', 'string', 'max:255'],

    // ================= VARIANTS =================
    'variants' => ['required','array','min:1'],
'variants.*.sku' => [
    'required',
    'string',
    'max:100',
    'distinct',
    'unique:product_variants,sku'
],
    'variants.*.color_name' => ['nullable', 'string', 'max:50'],
    'variants.*.color_hex' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6})$/'],
    'variants.*.size' => ['nullable', 'string', 'max:20'],
    'variants.*.stock_count' => ['nullable', 'integer'],
    'variants.*.additional_cost' => ['nullable', 'numeric', 'min:0'],

    // ================= IMAGES =================
    'images' => ['required','array','min:1'],
'images.*.image_url' => ['required','string','max:500'],
    'images.*.image_type' => ['nullable', 'in:mockup,preview,lifestyle'],
    'images.*.angle' => ['nullable', 'string', 'max:50'],
    'images.*.alt_text' => ['nullable', 'string', 'max:255'],

    // ================= ATTRIBUTES =================
  'attrs' => ['nullable', 'array'],

'attrs.*.attribute_id' => [
    'nullable',
    'exists:product_attributes,id'
],

'attrs.*.value' => [
    'nullable',
    'required_if:attrs.*.attribute_id,!=,null',
    'string',
    'max:100'
],

    // ================= TAGS =================
    'tag_ids' => ['nullable', 'array'],
    'tag_ids.*' => ['exists:product_tags,id'],
]);

        // checkboxes
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);
        $validated['is_embroidery_compatible'] = $request->boolean('is_embroidery_compatible', false);

        // slug is NOT NULL + UNIQUE in DB
        $baseSlug = trim($validated['slug'] ?? '');
        $baseSlug = $baseSlug !== '' ? Str::slug($baseSlug) : Str::slug($validated['name']);
        if ($baseSlug === '') $baseSlug = 'product';
        $validated['slug'] = $this->uniqueSlug($baseSlug);

        // defaults
        $validated['min_dpi'] = $validated['min_dpi'] ?? 150;
        $validated['weight_grams'] = $validated['weight_grams'] ?? 0;

        return DB::transaction(function () use ($validated, $request) {

            // 1) create base product
            
            $product = Product::create([
                'name' => $validated['name'],
                'slug' => $validated['slug'],
                'description' => $validated['description'] ?? null,
                'short_description' => $validated['short_description'] ?? null,
                'base_price' => $validated['base_price'],
                'category_id' => $validated['category_id'],
                'is_active' => $validated['is_active'] ? 1 : 0,
                'is_featured' => $validated['is_featured'] ? 1 : 0,
                'is_embroidery_compatible' => $validated['is_embroidery_compatible'] ? 1 : 0,
                'print_area_width' => $validated['print_area_width'] ?? null,
                'print_area_height' => $validated['print_area_height'] ?? null,
                'min_dpi' => $validated['min_dpi'],
                'mockup_template' => $request->input('mockup_template'),
                'weight_grams' => $validated['weight_grams'],
            ]);

            // 2) variants
            $variants = $request->input('variants', []);
            if (is_array($variants)) {
                $cleanVariants = [];
                foreach ($variants as $v) {
                    if (empty($v['sku'])) continue;
                    $cleanVariants[] = [
                        'sku' => $v['sku'],
                        'color_name' => $v['color_name'] ?? null,
                        'color_hex' => $v['color_hex'] ?? null,
                        'size' => $v['size'] ?? null,
                        'weight_grams' => 0,
                        'stock_count' => $v['stock_count'] ?? -1,
                        'is_active' => 1,
                        'additional_cost' => $v['additional_cost'] ?? 0.00,
                    ];
                }
                if (count($cleanVariants) > 0) {
                    $product->variants()->createMany($cleanVariants);
                }
            }

            // 3) images
            $images = $request->input('images', []);
            if (is_array($images)) {
                $order = 0;
                foreach ($images as $img) {
                    if (empty($img['image_url'])) continue;
                    $product->images()->create([
                        'variant_id' => null,
                        'image_url' => $img['image_url'],
                        'image_type' => $img['image_type'] ?? 'mockup',
                        'angle' => $img['angle'] ?? null,
                        'display_order' => $order++,
                        'alt_text' => $img['alt_text'] ?? null,
                    ]);
                }
            }

            // 4) attributes (product_attribute_values has UNIQUE(product_id, attribute_id))
            $attrs = $request->input('attrs', []);
            if (is_array($attrs)) {
                $display = 0;
                foreach ($attrs as $a) {
                    $val = trim((string)($a['value'] ?? ''));
                    if ($val === '' || empty($a['attribute_id'])) continue;

                   $product->attributes()->updateOrCreate(
    [
        'product_id' => $product->id,
        'attribute_id' => (int)$a['attribute_id'],
    ],
    [
        'value' => $val,
        'display_order' => $display++,
    ]
);
                }
            }

            // 5) tags (pivot product_tag_assignments)
            $tagIds = $request->input('tag_ids', []);
            if (is_array($tagIds)) {
                $product->tags()->sync(array_values(array_unique(array_map('intval', $tagIds))));
            }

            return redirect()
                ->back()
                ->with('success', 'Base product saved successfully!')
                ->with('product_id', $product->id);
        });
    }

    private function uniqueSlug(string $base): string
    {
        $slug = $base;
        $i = 1;
        while (Product::where('slug', $slug)->exists()) {
            $i++;
            $slug = $base . '-' . $i;
        }
        return $slug;
    }

   
   
    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        // ================= PRODUCTS =================
        'name' => ['required', 'string', 'max:200'],
        'slug' => ['nullable', 'string', 'max:200'],
        'category_id' => ['required', 'exists:categories,id'],
        'base_price' => ['required', 'numeric', 'min:0'],
        'short_description' => ['nullable', 'string', 'max:500'],
        'description' => ['nullable', 'string'],
        'weight_grams' => ['nullable', 'integer', 'min:0'],
        'print_area_width' => ['nullable', 'integer', 'min:0'],
        'print_area_height' => ['nullable', 'integer', 'min:0'],
        'min_dpi' => ['nullable', 'integer', 'min:72'],
        'mockup_template' => ['nullable', 'string', 'max:255'],

        // ================= VARIANTS =================
        'variants' => ['nullable', 'array'],
        'variants.*.sku' => ['required_with:variants', 'string', 'max:100'],
        'variants.*.color_name' => ['nullable', 'string', 'max:50'],
        'variants.*.color_hex' => ['nullable', 'regex:/^#([A-Fa-f0-9]{6})$/'],
        'variants.*.size' => ['nullable', 'string', 'max:20'],
        'variants.*.stock_count' => ['nullable', 'integer'],
        'variants.*.additional_cost' => ['nullable', 'numeric', 'min:0'],

        // ================= IMAGES =================
        'images' => ['nullable', 'array'],
        'images.*.image_url' => ['required_with:images','string','max:500'],
        'images.*.image_type' => ['nullable', 'in:mockup,preview,lifestyle'],
        'images.*.angle' => ['nullable', 'string', 'max:50'],
        'images.*.alt_text' => ['nullable', 'string', 'max:255'],

        // ================= ATTRIBUTES =================
        'attrs' => ['nullable','array'],
        'attrs.*.attribute_id' => ['required','integer','exists:product_attributes,id'],
        'attrs.*.value' => ['nullable','string','max:100'],

        // ================= TAGS =================
        'tag_ids' => ['nullable', 'array'],
        'tag_ids.*' => ['exists:product_tags,id'],
    ]);

    // checkboxes
    $validated['is_active'] = $request->boolean('is_active', true);
    $validated['is_featured'] = $request->boolean('is_featured', false);
    $validated['is_embroidery_compatible'] = $request->boolean('is_embroidery_compatible', false);

    // slug logic
    $baseSlug = trim($validated['slug'] ?? '');
    $baseSlug = $baseSlug !== '' ? Str::slug($baseSlug) : Str::slug($validated['name']);
    if ($baseSlug === '') $baseSlug = 'product';
    
    // Only make slug unique if it changed
    if ($baseSlug !== $product->slug) {
        $validated['slug'] = $this->uniqueSlug($baseSlug);
    } else {
        $validated['slug'] = $product->slug;
    }

    // defaults
    $validated['min_dpi'] = $validated['min_dpi'] ?? 150;
    $validated['weight_grams'] = $validated['weight_grams'] ?? 0;

    return DB::transaction(function () use ($validated, $request, $product) {

        // 1) Update base product
        $product->update([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'description' => $validated['description'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'base_price' => $validated['base_price'],
            'category_id' => $validated['category_id'],
            'is_active' => $validated['is_active'] ? 1 : 0,
            'is_featured' => $validated['is_featured'] ? 1 : 0,
            'is_embroidery_compatible' => $validated['is_embroidery_compatible'] ? 1 : 0,
            'print_area_width' => $validated['print_area_width'] ?? null,
            'print_area_height' => $validated['print_area_height'] ?? null,
            'min_dpi' => $validated['min_dpi'],
            'mockup_template' => $request->input('mockup_template'),
            'weight_grams' => $validated['weight_grams'],
        ]);

        // 2) Variants - replace all
        $product->variants()->delete();
        $variants = $request->input('variants', []);
        if (is_array($variants)) {
            $cleanVariants = [];
            foreach ($variants as $v) {
                if (empty($v['sku'])) continue;
                $cleanVariants[] = [
                    'sku' => $v['sku'],
                    'color_name' => $v['color_name'] ?? null,
                    'color_hex' => $v['color_hex'] ?? null,
                    'size' => $v['size'] ?? null,
                    'weight_grams' => 0,
                    'stock_count' => $v['stock_count'] ?? -1,
                    'is_active' => 1,
                    'additional_cost' => $v['additional_cost'] ?? 0.00,
                ];
            }
            if (count($cleanVariants) > 0) {
                $product->variants()->createMany($cleanVariants);
            }
        }

        // 3) Images - replace all
        $product->images()->delete();
        $images = $request->input('images', []);
        if (is_array($images)) {
            $order = 0;
            foreach ($images as $img) {
                if (empty($img['image_url'])) continue;
                $product->images()->create([
                    'variant_id' => null,
                    'image_url' => $img['image_url'],
                    'image_type' => $img['image_type'] ?? 'mockup',
                    'angle' => $img['angle'] ?? null,
                    'display_order' => $order++,
                    'alt_text' => $img['alt_text'] ?? null,
                ]);
            }
        }

        // 4) Attributes - updateOrCreate
        $attrs = $request->input('attrs', []);
        if (is_array($attrs)) {
            $display = 0;
            foreach ($attrs as $a) {
                $val = trim((string)($a['value'] ?? ''));
                if ($val === '' || empty($a['attribute_id'])) continue;

                $product->attributes()->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'attribute_id' => (int)$a['attribute_id'],
                    ],
                    [
                        'value' => $val,
                        'display_order' => $display++,
                    ]
                );
            }
        }

        // 5) Tags
        $tagIds = $request->input('tag_ids', []);
        if (is_array($tagIds)) {
            $product->tags()->sync(array_values(array_unique(array_map('intval', $tagIds))));
        }

        return redirect()
            ->route('products')
            ->with('success', 'Base product updated successfully!')
            ->with('product_id', $product->id);
    });
}

public function showEdit($id)
{
    $product = Product::with(['variants', 'images', 'attributes', 'tags'])->findOrFail($id);

    $categories = Category::all();
    $attributes = ProductAttribute::all();
    $tags = ProductTag::all();

    return view('admin.editProd', compact('product', 'categories', 'attributes', 'tags'));
}

} 



