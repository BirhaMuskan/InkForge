<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Details</title>

<style>
    body {
        font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        background: #f5f7fb;
        margin: 0;
        padding: 30px;
        color: #1f2937;
    }

    .container {
        max-width: 1200px;
        margin: auto;
    }

    h1 {
        font-size: 26px;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 16px;
        margin-bottom: 10px;
        color: #111827;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(0,0,0,.05);
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .info p {
        margin: 6px 0;
        font-size: 14px;
    }

    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .badge-success { background: #e6f7ef; color: #059669; }
    .badge-danger { background: #fee2e2; color: #dc2626; }
    .badge-primary { background: #e0e7ff; color: #4338ca; }

    ul {
        padding-left: 18px;
        margin: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th, td {
        padding: 10px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }

    th {
        background: #f9fafb;
        font-weight: 600;
    }

    .image-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .image-grid img {
        width: 100%;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .section {
        margin-top: 30px;
    }

    .stat {
        font-size: 14px;
        margin-bottom: 6px;
    }

    @media (max-width: 900px) {
        .grid {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>


<body>

<div class="container">

    <h1>{{ $product->name }}</h1>

    <div class="grid">

        <!-- LEFT -->
        <div class="card info">
            <h2>Basic Info</h2>
            <p><strong>Category:</strong> {{ $product->category->name ?? '—' }}</p>
            <p><strong>Price:</strong> ${{ $product->base_price }}</p>

            <p><strong>Status:</strong>
                @if($product->is_active)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
            </p>

            <p><strong>Featured:</strong>
                @if($product->is_featured)
                    <span class="badge badge-primary">Yes</span>
                @else
                    No
                @endif
            </p>

            <h2 style="margin-top:20px;">Attributes</h2>
            <ul>
                @foreach($product->attributes as $attr)
                    <li>{{ $attr->attribute->name }}: {{ $attr->value }}</li>
                @endforeach
            </ul>

            <h2 style="margin-top:20px;">Tags</h2>
            <ul>
                @foreach($product->tags as $tag)
                    <li>{{ $tag->name }}</li>
                @endforeach
            </ul>
        </div>

        <!-- RIGHT -->
        <div class="card">
            <h2>Variants</h2>
            <table>
                <thead>
                    <tr>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product->variants as $variant)
                    <tr>
                        <td>{{ $variant->size }}</td>
                        <td>{{ $variant->color_name }}</td>
                        <td>{{ $variant->stock_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h2 style="margin-top:20px;">Images</h2>
            <div class="image-grid">
                @foreach($product->images as $image)
                    <img src="{{ asset($image->url) }}" alt="">
                @endforeach
            </div>
        </div>
    </div>

    <!-- REVIEWS -->
    <div class="card section">
        <h2>Reviews</h2>
        <p class="stat">Total Reviews: {{ $product->reviews->count() }}</p>
        <p class="stat">Average Rating: {{ $product->rating_avg ?? '—' }}</p>
    </div>

    <!-- LISTINGS -->
    <div class="card section">
        <h2>Listings</h2>
        <table>
            <thead>
                <tr>
                    <th>Design</th>
                    <th>Seller</th>
                    <th>Price</th>
                    <th>Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->listings as $listing)
                <tr>
                    <td>{{ $listing->design->name ?? '—' }}</td>
                    <td>{{ $listing->seller->name ?? '—' }}</td>
                    <td>${{ $listing->final_price }}</td>
                    <td>{{ $listing->sales_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
