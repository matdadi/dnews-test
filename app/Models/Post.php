<?php

namespace App\Models;

use App\Traits\HasActiveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasActiveStatus;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image_id',
        'meta',
        'post_text',
        'subcategory_id',
        'is_published',
        'is_active',
        'created_by',
        'updated_by'
    ];

    public function casts(): array
    {
        return [
            'is_active' => 'boolean'
        ];
    }

    public function subcategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(File::class);
    }

    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

//    attribute

    public function getPublishBadgeAttribute()
    {
        return $this->is_published ? '<span class="badge bg-blue text-blue-fg">' . $this->publish_string . '</span>' : '<span class="badge bg-danger text-danger-fg">' . $this->publish_string . '</span>';
    }

    public function getPublishStringAttribute()
    {
        return $this->is_published ? 'Published' : 'Not Published';
    }
}
