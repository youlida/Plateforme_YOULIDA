<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbonneNewsletter extends Model
{
    protected $table = 'abonne_newsletters';

    protected $fillable = [
        'email',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}