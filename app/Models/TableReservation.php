<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TableReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'number_of_people',
        'reservation_date',
        'reservation_time',
        'special_requests',
        'status'
    ];
}

