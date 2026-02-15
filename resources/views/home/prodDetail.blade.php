
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            body {
      font-family: Arial, sans-serif;
      background: #fff;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 40px;
    }

    /* Product Images */
    .product-images {
      flex: 1;
      min-width: 300px;
    }

    .product-images img.main {
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .thumbnails {
      margin-top: 10px;
      display: flex;
      gap: 10px;
    }

    .thumbnails img {
      width: 60px;
      height: 60px;
      border-radius: 6px;
      cursor: pointer;
      border: 2px solid transparent;
      transition: all 0.2s ease;
    }

    .thumbnails img:hover,
    .thumbnails img.active {
      border-color: #6b21a8;
      box-shadow: 0 4px 8px rgba(107,33,168,0.3);
    }

    /* Product Info */
    .product-info {
      flex: 1;
      min-width: 300px;
    }

    .product-info h1 {
      font-size: 28px;
      margin-bottom: 10px;
    }

    .product-info p {
      margin: 5px 0;
    }

    .price {
      font-size: 24px;
      font-weight: bold;
      color: #6b21a8;
    }

    .price .original {
      text-decoration: line-through;
      color: #999;
      margin-left: 10px;
      font-weight: normal;
    }

    .discount {
      color: #a855f7;
      font-weight: bold;
      margin-top: 5px;
    }

    /* Style Section */
    .product-info .style,
    .product-info .color,
    .product-info .size,
    .product-info .features {
      margin-top: 20px;
    }

    .section-title {
      font-weight: bold;
      margin-bottom: 8px;
    }

    .style-desc {
      border: 1px solid #ccc;
      padding: 8px;
      border-radius: 6px;
    }

    /* Color Circles */
    .color-circle {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      display: inline-block;
      margin-right: 6px;
      border: 2px solid #ccc;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .color-circle:hover {
      transform: scale(1.2);
      border-color: #6b21a8;
    }

    .color-circle.active {
      border-color: #6b21a8;
      box-shadow: 0 0 0 3px rgba(107,33,168,0.3);
    }

    /* Size Buttons */
    .size-btn {
      padding: 6px 12px;
      margin: 4px;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.2s ease;
      background-color: #fff;
    }

    .size-btn:hover {
      background-color: #ede9fe;
      border-color: #7c3aed;
    }

    .size-btn.active {
      background-color: #ede9fe;
      border-color: #7c3aed;
    }

    /* Add to Cart */
    .add-cart-btn {
      margin-top: 20px;
      padding: 12px 24px;
      background-color: #ec4899;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .add-cart-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255,105,180,0.4);
    }

    /* Delivery Info */
    .delivery {
      margin-top: 20px;
      font-size: 14px;
      color: #555;
    }

    .delivery .gift {
      color: #ef4444;
      text-decoration: underline;
      cursor: pointer;
    }

    /* Product Features */
    .features ul {
      list-style: disc inside;
      margin: 8px 0;
      color: #444;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }
    }

    </style>
</head>
<body>
    
<div class="container" style="display:flex; gap:40px; flex-wrap:wrap;">

    <!-- Product Images -->
    <div class="product-images" style="flex:1; min-width:300px;">

        <div class="product-images" style="flex:1; min-width:300px;">

    {{-- Main Image --}}
    <img id="mainImage" class="main"
         src="{{ $galleryImages ? Storage::url(reset($galleryImages)) : 'https://via.placeholder.com/400' }}"
         alt="{{ $product->name }}">

    {{-- Thumbnails --}}
    <div class="thumbnails" style="display:flex; gap:10px; margin-top:10px;">
        @if(!empty($galleryImages))
            @foreach($galleryImages as $position => $image)
                <img src="{{ Storage::url($image) }}"
                     onclick="changeMain(this)"
                     style="width:60px; height:60px; cursor:pointer; border:2px solid transparent;">
            @endforeach
        @endif
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
    // Thumbnail image click
    function changeMain(el) {
        document.getElementById('mainImage').src = el.src;
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