<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityUser extends Model
{
    protected $table = 'facility_users';
    protected $primaryKey = 'id';


    protected $casts = [
        'users_id ' => 'integer',
        'facilities_id ' => 'integer',
    ];
    protected $fillable = [
        'users_id',
        'facilities_id'
    ];
}
