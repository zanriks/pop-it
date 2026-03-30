<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $primaryKey = 'buildingId';

    public $incrementing = true;

    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'buildingId',
        'buildingName',
        'address',
        'phone',
        'floors'
    ];
}