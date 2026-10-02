<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnershipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'organization',
        'contact_name',
        'contact_function',
        'email',
        'phone',
        'proposal',
        'wants_callback',
        'internal_summary',
        'action_taken',
        'follow_up',
        'status',
        'assigned_to',
    ];

    protected $casts = [
        'wants_callback' => 'boolean',
    ];

    public function assignedUser()
    {
        return $this->belongsTo(
            User::class,
            'assigned_to'
        );
    }
}
