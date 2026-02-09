<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Products</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#f7f8fc;
}

/* Layout */
.container{
    display:flex;
    padding:40px 60px;
    gap:40px;
}

/* Sidebar */
.sidebar{
    width:260px;
    background:#fff;
    padding:25px;
    border-radius:12px;
    box-shadow:0 4px 20px rgba(0,0,0,0.05);
    height:fit-content;
    position:sticky;
    top:20px;
}

.sidebar h3{
    font-size:18px;
    margin-bottom:15px;
    font-weight:600;
}

.color-grid{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:8px;
    margin-bottom:30px;
}
/* 
.color-grid div{
    width:28px;
    height:28px;
    border-radius:6px;
    cursor:pointer;
    transition:0.3s;
} */

.color-grid div:hover{
    transform:scale(1.2);
}

.price-range{
    margin-bottom:30px;
}

.category label{
    display:block;
    margin-bottom:10px;
    cursor:pointer;
    font-size:14px;
}
/* Color selection */
.color-grid label {
    display: inline-block;
    cursor: pointer;
    position: relative;
}

.color-grid input[type="radio"]:checked + div {
    border: 3px solid #000; /* thicker border for selected */
    transform: scale(1.2);  /* pop effect */
}

.color-grid div {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    transition: 0.3s;
    border: 2px solid transparent; /* default border */
}

/* Optional check mark inside selected color */

.color-grid input[type="radio"]:checked + div::after {
    content: "✔";
    color: #fff;
    font-size: 16px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}



/* Main Content */
.content{
    flex:1;
}

/* Top Bar */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.topbar select{
    padding:8px 15px;
    border-radius:6px;
    border:1px solid #ddd;
}

/* Product Grid */
.products{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
}

.card{
    background:#fff;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
    transition:0.3s;
    text-align:center;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.card img{
    width:100%;
    height:220px;
    object-fit:contain;
    transition:0.4s;
}

.card:hover img{
    transform:scale(1.08);
}

.card h4{
    font-size:15px;
    margin:15px 0 5px;
    font-weight:600;
}

.price{
    color:#e63946;
    font-weight:700;
}

/* Responsive */
@media(max-width:1200px){
    .products{
        grid-template-columns:repeat(3,1fr);
    }
}

@media(max-width:900px){
    .container{
        flex-direction:column;
    }
    .sidebar{
        width:100%;
        position:relative;
    }
    .products{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:500px){
    .products{
        grid-template-columns:1fr;
    }
}
</style>
</head>
<body>

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
            <h2>All Products</h2>
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

    <div class="card">
        <img src="{{ $image }}" alt="{{ $listing->seo_title ?? $product->name }}">

        <h4>{{ $listing->seo_title ?? $product->name }}</h4>

        <div class="price">
            ${{ number_format($listing->final_price, 2) }}
        </div>
    </div>

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
