<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
    public function commune()
    {
        return $this->belongsTo(ShipCommune::class, 'commune_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
