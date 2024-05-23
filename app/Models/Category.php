<?php

namespace App\Models;

use App\Traits\HasActiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasActiveStatus;

    protected $fillable = ['title', 'slug', 'icon_id', 'sort', 'is_active', 'created_by', 'updated_by'];

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function icon()
    {
        return $this->belongsTo(File::class);
    }

    public function user_created()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, Subcategory::class);
    }
}
