<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'author_id',

        'title',
        'slug',

        'short_description',
        'content',

        'featured_image',

        'source',
        'location',

        'tags',

        'meta_title',
        'meta_description',
        'meta_keywords',

        'status',

        'is_breaking',
        'is_featured',
        'is_trending',

        'published_at',

        'views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_breaking' => 'boolean',
        'is_featured' => 'boolean',
        'is_trending' => 'boolean',
    ];

    // Category Relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Sub Category Relationship
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    // Author Relationship
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
