<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'category_id'];

    public function Category() {
        return $this->belongsTo(Category::class);
    }

    public function Products() {
        return $this->hasMany(Product::class);
    }
}
