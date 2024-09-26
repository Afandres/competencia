<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'document_type',
        'document_number',
        'telephone',
        'email',
        'stratum',
        'address'
    ];

    /**
     * Relación: una persona puede tener varios usuarios (si fuera necesario).
     * Esto es opcional si en tu sistema una persona solo puede tener un usuario.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function apprentice()
    {
        return $this->hasOne(Apprentice::class);
    }

}
