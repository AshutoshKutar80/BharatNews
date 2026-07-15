<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'display_order',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
