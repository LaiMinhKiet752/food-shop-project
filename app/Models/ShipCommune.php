<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipCommune extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function city()
    {
        return $this->belongsTo(ShipCity::class, 'city_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(ShipDistricts::class, 'district_id', 'id');
    }
}
