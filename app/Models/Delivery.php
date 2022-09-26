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
    protected $appends = array('FormaPago', 'Retorno');
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

    public function getFormaPagoAttribute()
    {
        if ($this->payment_method == 1) {
            return "CASH";
        } elseif ($this->payment_method == 2) {
            return "CHECK";
        } elseif ($this->payment_method == 3) {
            return "CREDIT CARD";
        } elseif ($this->payment_method == 4) {
            return "CHARGE ACCOUNT";
        }
    }

    public function getRetornoAttribute()
    {
        if ($this->returned == 1) {
            return "YES";
        } elseif ($this->returned == 0) {
            return "NO";
        }
    }
}
