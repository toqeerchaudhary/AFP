<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $fillable = ["name"];

    public function Products() {
        return $this->hasMany(Product::class);
    }
}
