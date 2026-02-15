<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Products</title>
<link rel="stylesheet" href="{{asset('home/css/Cardstyle.css')}}">
<link rel="stylesheet" href="{{asset('home/css/nav.css')}}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>
@include('home.homeLayout')
<div class="container">

    <!-- Sidebar -->
    <form method="GET" action="{{ route('cards') }}">
    <div class="sidebar">

        <h3>Color</h3>
        <div class="color-grid">
   @foreach($colors as $color)
<label>
    <input type="radio"
           name="color"
           value="{{ $color }}"
           {{ request('color') == $color ? 'checked' : '' }}
           hidden>
    <div style="background: {{ $color }};"></div>
</label>
@endforeach

        </div>

        <h3>Price</h3>
        <div class="price-range">
       <input type="range"
       name="max_price"
       min="0"
       max="500"
       value="{{ request('max_price') ?? 500 }}"
       oninput="this.nextElementSibling.value=this.value">

            <output>{{ request('max_price') ?? 500 }}</output>
        </div>

        <h3>Category</h3>
        <div class="category">
            @foreach($categories as $category)
                <label>
                    <input type="checkbox"
       name="category[]"
       value="{{ $category->id }}"
       {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}>

                    {{ $category->name }}
                </label>
            @endforeach
        </div>

        <button type="submit" style="margin-top:15px; padding:8px 12px; border-radius:6px; background:#1d3557; color:#fff; border:none; cursor:pointer;">
    Apply
</button>
<a href="{{ route('cards') }}" 
   style="display:inline-block; margin-top:10px; padding:8px 12px; background:#e63946; color:#fff; border-radius:6px; text-decoration:none; font-size:14px;">
   Clear Filters
</a>


    </div>
    
</form>


    <!-- Content -->
    <div class="content">
        <div class="topbar">
            <h2>
    @if(request('category'))
        Showing: {{ \App\Models\Category::whereIn('id', request('category'))->pluck('name')->join(', ') }}
    @else
        All Products
    @endif
</h2>

           <form method="GET" id="sortForm">
@if(request('category'))
    @foreach(request('category') as $cat)
        <input type="hidden" name="category[]" value="{{ $cat }}">
    @endforeach
@endif

    <input type="hidden" name="color" value="{{ request('color') }}">
    <input type="hidden" name="max_price" value="{{ request('max_price') }}">

    <select name="sort" onchange="this.form.submit()">
        <option value="">Sort by: Latest</option>
        <option value="low" {{ request('sort')=='low'?'selected':'' }}>
            Price Low to High
        </option>
        <option value="high" {{ request('sort')=='high'?'selected':'' }}>
            Price High to Low
        </option>
    </select>
</form>


        </div>

        <div class="products">

@forelse($listings as $listing)

    @php
        $product = $listing->product;
         $image = ($listing->design && $listing->design->thumbnail)
      ? \Illuminate\Support\Facades\Storage::url($listing->design->thumbnail)
      : 'https://via.placeholder.com/300';
    @endphp

    <a href="{{ route('product.show', $product->slug) }}" class="card">
        <img src="{{ $image }}" alt="{{ $listing->seo_title ?? $product->name }}">

        <h4>{{ $listing->seo_title ?? $product->name }}</h4>

        <div class="price">
            ${{ number_format($listing->final_price, 2) }}
        </div>
    </a>

@empty
    <p>No products found.</p>
@endforelse

</div>

<!-- <div style="margin-top:30px">
   {{ $listings->appends(request()->query())->links() }}
</div> -->

    </div>

</div>

</body>
</html>
