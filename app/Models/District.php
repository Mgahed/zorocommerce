<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order()
    {
        return $this->hasMany(Order::class, 'district_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(ShipDivision::class, 'city_id', 'id');
    }
}
