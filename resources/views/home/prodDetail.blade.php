
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('home/css/cardDetail.css')}}">
    <link rel="stylesheet" href="{{asset('home/css/nav.css')}}">
</head>
<body>
    @include('home.homeLayout')
<div class="container" style="display:flex; gap:40px; flex-wrap:wrap;">

    <!-- Product Images -->
    <!-- Product Images -->
<div class="product-images">

    <div class="image-wrapper">

        {{-- Thumbnails (LEFT SIDE) --}}
        <div class="thumbnails">
            @if(!empty($galleryImages))
                @foreach($galleryImages as $position => $image)
                    <img src="{{ Storage::url($image) }}"
                         onclick="changeMain(this)">
                @endforeach
            @endif
        </div>

        {{-- Main Image (RIGHT SIDE) --}}
        <div class="main-image">
            <img id="mainImage" class="main"
                 src="{{ $galleryImages ? Storage::url(reset($galleryImages)) : 'https://via.placeholder.com/400' }}"
                 alt="{{ $product->name }}">
        </div>

    </div>

</div>


    <!-- Product Info -->
    <div class="product-info" style="flex:1; min-width:300px;">
        <h1>{{ $product->name }}</h1>
        <p>{{ $product->short_description ?? $product->description }}</p>

        <div class="price">
            ${{ $listing ? number_format($listing->final_price, 2) : number_format($product->base_price, 2) }}
        </div>

        <div class="discount"> <!-- Example: you can calculate if needed -->
            {{ $listing && $listing->final_price < $product->base_price ? 'Discount available!' : '' }}
        </div>

        <!-- Variants -->
        @if($product->variants->count())
            <div class="size">
                <div class="section-title">Sizes</div>
                @foreach($product->variants as $variant)
                    <button class="size-btn" onclick="selectSize(this)">{{ $variant->size }}</button>
                @endforeach
            </div>

            <div class="color">
                <div class="section-title">Colors</div>
                @foreach($product->variants as $variant)
                    <span class="color-circle" 
                          style="background: {{ $variant->color_hex ?? '#ccc' }};" 
                          onclick="selectColor(this)"></span>
                @endforeach
            </div>
        @endif

        <!-- Add to Cart -->
        <button class="add-cart-btn">Add to Cart</button>

        <!-- Product Features -->
        @if($product->attributes->count())
            <div class="features">
                <div class="section-title">Features</div>
                <ul>
                    @foreach($product->attributes as $attr)
                        <li>{{ $attr->attribute->name ?? $attr->value }}: {{ $attr->value }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>

<script>
    function changeMain(el) {
    document.getElementById('mainImage').src = el.src;

    document.querySelectorAll('.thumbnails img')
        .forEach(img => img.classList.remove('active'));

    el.classList.add('active');
}


    // Color selection
    function selectColor(el) {
        document.querySelectorAll('.color-circle').forEach(c => c.classList.remove('active'));
        el.classList.add('active');
    }

    // Size selection
    function selectSize(el) {
        document.querySelectorAll('.size-btn').forEach(s => s.classList.remove('active'));
        el.classList.add('active');
    }
</script>
</body>
</html>