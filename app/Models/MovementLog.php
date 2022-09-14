<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementLog extends Model
{
    use HasFactory;
    protected $table = 'movement_logs';
    protected $primaryKey = 'id';
    protected $dates = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'scanners_id' => 'integer',
        'start' => 'datetime:Y-m-d H:i:s',
        'end' => 'datetime:Y-m-d H:i:s',
        'deleted_by' => 'integer',
        'updated_by' => 'integer',
        'created_by' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'scanners_id',
        'start',
        'end',
        'user'
    ];


    public function scanner()
    {
        return $this->hasOne(Scanner::class, 'id', 'scanners_id');
    }
}
