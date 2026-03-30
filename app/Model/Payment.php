<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'paymentPeriod',
        'accrualAmount',
        'paidAmount',
        'paymentDate',
        'paymentType',
        'paymentStatus'
    ];
}