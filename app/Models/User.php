<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Models\Shop;
use App\Models\UserDesign;
use App\Models\ProductReview;
use App\Models\Wishlist;
use App\Models\ProductListing;
use App\Models\DesignTemplate;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
       protected $table = 'users';

    protected $fillable = [
        'email',
        'username',
        'role',
        'first_name',
        'last_name',
        'avatar_url',
        'is_active',
        'password_hash'
    ];
    
public function shop()
{
    return $this->hasOne(Shop::class, 'seller_id');
}

public function designs()
{
    return $this->hasMany(UserDesign::class);
}

public function reviews()
{
    return $this->hasMany(ProductReview::class);
}

public function wishlists()
{
    return $this->hasMany(Wishlist::class);
}

public function listings()
{
    return $this->hasMany(ProductListing::class, 'seller_id');
}

public function uploadedTemplates()
{
    return $this->hasMany(DesignTemplate::class, 'uploader_id');
}


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    // public function initials(): string
    // {
    //     return Str::of($this->name)
    //         ->explode(' ')
    //         ->take(2)
    //         ->map(fn ($word) => Str::substr($word, 0, 1))
    //         ->implode('');
    // }
    public function initials(): string
{
    $text = trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    $text = $text !== '' ? $text : ($this->username ?? $this->email);

    return Str::of($text)
        ->explode(' ')
        ->take(2)
        ->map(fn ($word) => Str::substr($word, 0, 1))
        ->implode('');
}
}
