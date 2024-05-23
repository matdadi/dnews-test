<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'category_id', 'is_active', 'created_by', 'updated_by'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
