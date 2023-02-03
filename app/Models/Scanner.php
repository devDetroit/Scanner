<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scanner extends Model
{

    use SoftDeletes;
    const DISPONIBLE = 0;
    const ENUSO = 1;

    use HasFactory;
    protected $table = 'scanners';
    protected $primaryKey = 'id';
    protected $appends = array('Tiempo');
    protected $dates = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'status' => 'integer',
        'facility_id' => 'integer',
        'active' => 'integer',
        'deleted_by' => 'integer',
        'updated_by' => 'integer',
        'created_by' => 'integer',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'description',
        'status',
        'facility_id',
        'active', 
        'type'
    ];

    public function ultimoregistro()
    {
        return $this->hasOne(MovementLog::class, 'scanners_id', 'id')->orderBy('created_at', 'desc');
    }

    public function getTiempoAttribute()
    {

        if ($this->ultimoregistro['end'] == null) {
            $fechainicial = new Carbon($this->ultimoregistro['start']);

            $time = Carbon::now()->diffInMinutes($fechainicial);
            return number_format($time / 60, 2);
        } else {
            return 0;
        }
    }

    public function facility()
    {
        return $this->hasOne(Facility::class, 'id', 'facility_id');
    }
}
