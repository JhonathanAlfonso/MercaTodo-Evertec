<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected $dates = ['published_at'];

    /**
     * Create the product route show
     */
    public function path()
    {
        return "/admin/products/{$this->id}";
    }

    /**
     * Return the relation product->category and category->product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return the relation product->tags and tags->product
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
