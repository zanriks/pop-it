<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;
    protected $primaryKey = 'tenantId';
    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'passportSeries',
        'passportNumber',
        'status',
        'userId'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}