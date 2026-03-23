<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'room_id',
        'building_id',
        'room_number',
        'floor',
        'room_type',
        'total_beds',
        'number_of_tenants'
    ];
}