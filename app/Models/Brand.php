<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function Products() {
        return $this->hasMany(Product::class);
    }

}
