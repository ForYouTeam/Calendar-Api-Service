<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarServiceModel extends Model
{
    use HasFactory;
    protected $table = "calendar_service";
    protected $fillable = [
        'id',
        'calendar_id',
        'sentUpdate',
        'startDateTime',
        'endDateTime',
        'name',
        'location',
        'status',
        'description',
    ];
}
