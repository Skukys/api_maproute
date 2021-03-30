<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $fillable= ['type', 'line', 'from_place_id', 'to_place_id', 'departure_time', 'arrival_time', 'distance', 'speed'];
    use HasFactory;
}
