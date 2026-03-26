<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $primaryKey = 'registrationId';

    public $timestamps = false;

    protected $fillable = [
        'roomId',
        'tenantId',
        'checkInDate',
        'checkOutDate',
        'orderNumber',
        'orderDate',
        'status',
        'paymentId'
    ];
    public function tenant()
    {
        return $this->hasMany(Tenant::class, 'tenantId', 'tenantId');
    }
    public function room()
    {
        return $this->hasMany(Room::class, 'roomId', 'roomId');
    }
}