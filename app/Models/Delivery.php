<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delivery extends Model
{
    use SoftDeletes;
    const DISPONIBLE = 0;
    const ENUSO = 1;

    use HasFactory;
    protected $table = 'deliveries';
    protected $primaryKey = 'id';
    protected $dates = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'payment_method' => 'integer',
        'returned' => 'integer',
        'parts_returned' => 'integer',
        'total' => 'float',
        'updated_by' => 'integer',
        'created_by' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'mail',
        'shop_name',
        'shop_address',
        'driver_assigned',
        'part_number',
        'payment_method',
        'returned',
        'parts_returned',
        'total',
    ];
}
