<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'display_order',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
