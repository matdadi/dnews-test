<?php

namespace App\Models;

use App\Traits\HasActiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasActiveStatus;

    protected $guard = 'admin';

    protected $fillable = [
        'fullname', 'email', 'password', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function casts(): array
    {
        return [
            'is_active' => 'boolean'
        ];
    }

//    Relationship
    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function subcategory(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function tag(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

}
