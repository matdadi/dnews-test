<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'content',
        'filetype',
        'created_by',
        'updated_by'
    ];

    protected function content(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => Image::read($value)->encode(new WebpEncoder(1))->toDataUri(),
        );
    }
}
