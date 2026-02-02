<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<h1 class="text-2xl font-bold mb-4">{{ $product->name }}</h1>

<div class="grid grid-cols-2 gap-6">
    <!-- Left Column: Basic Info -->
    <div>
        <h2 class="font-semibold mb-2">Basic Info</h2>
        <p>Category: {{ $product->category->name ?? '—' }}</p>
        <p>Price: ${{ $product->base_price }}</p>
        <p>Status: {{ $product->is_active ? 'Active' : 'Inactive' }}</p>
        <p>Featured: {{ $product->is_featured ? 'Yes' : 'No' }}</p>

        <!-- Attributes -->
        <h2 class="font-semibold mt-4 mb-2">Attributes</h2>
        <ul>
            @foreach($product->attributes as $attr)
                <li>{{ $attr->attribute->name }}: {{ $attr->value }}</li>
            @endforeach
        </ul>

        <!-- Tags -->
        <h2 class="font-semibold mt-4 mb-2">Tags</h2>
        <ul>
            @foreach($product->tags as $tag)
                <li>{{ $tag->name }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Right Column: Variants & Images -->
    <div>
        <!-- Variants -->
        <h2 class="font-semibold mb-2">Variants</h2>
        <table class="min-w-full border">
            <thead>
                <tr>
                    <th class="border px-2 py-1">Size</th>
                    <th class="border px-2 py-1">Color</th>
                    <th class="border px-2 py-1">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->variants as $variant)
                <tr>
                    <td class="border px-2 py-1">{{ $variant->size }}</td>
                    <td class="border px-2 py-1">{{ $variant->color_name }}</td>
                    <td class="border px-2 py-1">{{ $variant->stock_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Images -->
        <h2 class="font-semibold mt-4 mb-2">Images</h2>
        <div class="grid grid-cols-3 gap-2">
            @foreach($product->images as $image)
                <img src="{{ asset($image->url) }}" alt="Image" class="w-full h-24 object-cover rounded">
            @endforeach
        </div>
    </div>
</div>

<!-- Reviews Summary -->
<h2 class="font-semibold mt-6 mb-2">Reviews</h2>
<p>Total Reviews: {{ $product->reviews->count() }}</p>
<p>Average Rating: {{ $product->rating_avg ?? '—' }}</p>

<!-- Listings -->
<h2 class="font-semibold mt-6 mb-2">Listings</h2>
<table class="min-w-full border">
    <thead>
        <tr>
            <th class="border px-2 py-1">Design</th>
            <th class="border px-2 py-1">Seller</th>
            <th class="border px-2 py-1">Price</th>
            <th class="border px-2 py-1">Sales</th>
        </tr>
    </thead>
    <tbody>
        @foreach($product->listings as $listing)
        <tr>
            <td class="border px-2 py-1">{{ $listing->design->name ?? '—' }}</td>
            <td class="border px-2 py-1">{{ $listing->seller->name ?? '—' }}</td>
            <td class="border px-2 py-1">${{ $listing->final_price }}</td>
            <td class="border px-2 py-1">{{ $listing->sales_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>