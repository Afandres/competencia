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
        'name_user',
        'document_type',
        'document_number',
        'telephone',
        'email',
        'address',
    ];

    /**
     * Relación: una persona puede tener varios usuarios (si fuera necesario).
     * Esto es opcional si en tu sistema una persona solo puede tener un usuario.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
