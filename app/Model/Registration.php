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
        return $this->belongsTo(Tenant::class, 'tenantId', 'tenantId');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'roomId', 'roomId');
    }
    public static function getActiveRegistrations($date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }

        return self::where('status', 'active')
            ->where('checkInDate', '<=', $date)
            ->where('checkOutDate', '>=', $date)
            ->get();
    }
}