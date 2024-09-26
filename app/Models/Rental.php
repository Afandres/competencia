<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = [
        'person_id',
        'bicycle_id',
        'date',
        'start_time',
        'end_time',
        'state',
        'price',
        'start_latitude',
        'start_longitude',
        'end_latitude',
        'end_longitude',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function bicycle()
    {
        return $this->belongsTo(Bicycle::class);
    }

}
