<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprentice extends Model
{
    use HasFactory;

    // se definen los campos que pueden ser asignados masivamente
    protected $fillable = [
        'person_id',
        'course_id',
    ];

    /**
     * Relación con el modelo Person.
     * Un aprendiz pertenece a una persona.
     */
    
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Relación con el modelo Course.
     * Un aprendiz pertenece a un curso.
     */

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
