<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'buildingId',
        'roomNumber',
        'floor',
        'roomType',
        'totalBeds',
        'numberOfTenants'
    ];
}