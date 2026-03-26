<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'roomId';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'buildingId',
        'roomNumber',
        'floor',
        'roomType',
        'totalBeds',
        'numberOfTenants'
    ];
    public function building()
    {
        return $this->hasMany(Building::class, 'buildingId');
    }
}