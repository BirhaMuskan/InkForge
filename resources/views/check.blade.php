<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InkForge || User Detail</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('adminAssets/images/favicon.ico')}}" />
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/css/bootstrap.min.css')}}" />
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/vendors/css/vendors.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/vendors/css/daterangepicker.min.css')}}" />
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('adminAssets/css/theme.min.css')}}" />
</head>
<body>
    @include('admin.sidebar')

<div class="container py-4">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">User Details</h5>
            <a href="{{ route('users') }}" class="btn btn-secondary btn-sm">Back to Users</a>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center mb-4 gap-4">
                <img src="{{ $user->avatar_url }}" 
                     alt="{{ $user->username }}" 
                     width="100" height="100" 
                     class="rounded-circle border">
                <div>
                    <h4 class="mb-1">{{ $user->username }}</h4>
                    <p class="mb-0 text-muted">{{ $user->email }}</p>
                    <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                    @if($user->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </div>
            </div>

            <hr>

            <h5>Shop</h5>
            @if($user->shop)
                <p>Name: {{ $user->shop->name }}</p>
                <p>Floor: {{ $user->shop->floor }}</p>
                <p>Rent: ${{ $user->shop->rent }}</p>
            @else
                <p>No shop assigned.</p>
            @endif

            <hr>

            <h5>Statistics</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Designs: {{ $user->designs->count() }}</li>
                <li class="list-group-item">Listings: {{ $user->listings->count() }}</li>
                <li class="list-group-item">Reviews: {{ $user->reviews->count() }}</li>
                <li class="list-group-item">Wishlists: {{ $user->wishlists->count() }}</li>
            </ul>

            <hr>

            <h5>Other Info</h5>
            <p>Registered At: {{ $user->created_at->format('d M, Y') }}</p>
            <p>Last Updated: {{ $user->updated_at->format('d M, Y') }}</p>
        </div>
    </div>
</div>


</body>
</html>