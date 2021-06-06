<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'code'];


    public function Products() {
        return $this->hasMany(Product::class);
    }

    public function SubCategories() {
        return $this->hasMany(SubCategory::class);
    }
}
