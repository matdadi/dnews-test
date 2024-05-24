<?php

namespace App\Models;

use App\Traits\HasActiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory, HasActiveStatus;

    protected $fillable = ['category_id', 'title', 'slug', 'sort', 'icon_id', 'is_active', 'created_by', 'updated_by'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user_created()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
