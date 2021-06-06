<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];


    public function Category() {
        return $this->belongsTo(Category::class);
    }

    public function Brand() {
        return $this->belongsTo(Brand::class);
    }

    public function Supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function SubCategory() {
        return $this->belongsTo(SubCategory::class);
    }

    public function Uom() {
        return $this->belongsTo(Uom::class);
    }

    public function Quotations() {
        return $this->belongsToMany(Quotation::class)
            ->withPivot("quantity", "discount" ,"short_description", "sale_price", "total_price", "name")
            ->withTimestamps();
    }

    public function Inquiries() {
        return $this->belongsToMany(Quotation::class)
            ->withPivot("quantity", "short_description", "sale_price", "total_price", "name")->withTimestamps();
    }
}
