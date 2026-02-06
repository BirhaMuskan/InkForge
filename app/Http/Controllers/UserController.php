<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    
    // List users with filters
    public function users(Request $request)
    {
        $query = User::with([
            'shop',
            'designs',
            'reviews',
            'wishlists',
            'listings',
            'uploadedTemplates'
        ]);

        // Allowed roles for filtering (no guest)
        $allowedRoles = ['admin', 'customer', 'designer'];

        // Filters
        if ($request->role && in_array($request->role, $allowedRoles)) {
            $query->where('role', $request->role);
        }

        if ($request->status !== null) {
            $query->where('is_active', $request->status);
        }

        if ($request->has_shop === 'yes') {
            $query->whereHas('shop');
        }

        if ($request->has_shop === 'no') {
            $query->whereDoesntHave('shop');
        }

        $users = $query->latest()->get();

        // Stats
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', 1)->count();
        $inactiveUsers = User::where('is_active', 0)->count();
        $designers = User::where('role', 'designer')->count();

          // Prepare avatar URL
    foreach ($users as $user) {
    $user->avatar_src = $user->avatar_url
        ? asset('storage/' . $user->avatar_url)
        : asset('adminAssets/images/default-avatar.png');
}

        return view('admin.users', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'designers'
        ));
    }

    // Show user details
  public function show($id)
{
    $user = User::with([
        'shop',
        'designs',
        'reviews',
        'wishlists',
        'listings',
    ])->findOrFail($id);

    // Avatar URL
    $user->avatar_src = $user->avatar_url
    ? asset('storage/' . $user->avatar_url)
    : asset('adminAssets/images/default-avatar.png');

    return view('admin.userDetail', compact('user'));
}


   // Edit page
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = User::pluck('role')->unique();

    return view('admin.userEdit', compact('user', 'roles'));
    }

    // Update logic
   public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'username'  => 'required|string|max:255|unique:users,username,' . $user->id,
        'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
        'avatar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'role'      => 'required|in:admin,customer,designer',
        'is_active' => 'sometimes|accepted',
    ]);

    // Avatar upload
    if ($request->hasFile('avatar')) {
        // delete old avatar (only if you stored relative path like "avatars/xxx.jpg")
        if ($user->avatar_url && Storage::disk('public')->exists($user->avatar_url)) {
            Storage::disk('public')->delete($user->avatar_url);
        }

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar_url = $path; // ✅ correct column
    }

    $user->username  = $request->username;
    $user->email     = $request->email;
    $user->role      = $request->role;
    $user->is_active = $request->has('is_active') ? 1 : 0;

    $user->save();

    return redirect()->route('users')->with('success', 'User updated successfully!');
}

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting admin
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin cannot be deleted.');
        }

        $user->delete();

        return redirect()
            ->route('users')
            ->with('success', 'User deleted successfully.');
    }



}
