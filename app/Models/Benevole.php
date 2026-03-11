<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benevole extends Model
{
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'telephone',
        'pays',
        'ville',
        'motivation',
        'is_approved',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }
}