<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'start_date',
        'end_date',
        'state',
        'program_id'
    ];

    public function program ()
    {
        return $this->belongsTo(Program::class);
    }

    public function apprentices()
    {
        return $this->hasMany(Apprentice::class);
    }
}
