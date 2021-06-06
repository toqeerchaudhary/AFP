<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends Model
{
    use SoftDeletes;

    protected $guarded = ["id"];

    public function Seller() {
        return $this->belongsTo(Seller::class);
    }

    public function Coordinator() {
        return $this->belongsTo(Coordinator::class);
    }

    public function Customer() {
        return  $this->belongsTo(Customer::class);
    }

    public function Products() {
        return $this->belongsToMany(Product::class)
            ->withPivot("quantity", "short_description", "sale_price", "total_price", "name")->withTimestamps();
    }
}
