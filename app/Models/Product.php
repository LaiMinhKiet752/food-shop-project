<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'manufacturing_date' => 'datetime',
        'expire_date' => 'datetime',
    ];
    public function rVendor(){
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
    public function rCategory(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
