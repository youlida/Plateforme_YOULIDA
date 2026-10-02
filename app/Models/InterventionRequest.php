<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterventionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'structure_type',
        'structure_name',
        'contact_name',
        'contact_function',
        'phone',
        'email',
        'location',
        'need',
        'target_audience',
        'estimated_participants',
        'desired_period',
        'intervention_format',
        'duration',
        'additional_information',
        'internal_summary',
        'action_taken',
        'follow_up',
        'status',
        'assigned_to',
    ];

    protected $casts = [
        'estimated_participants' => 'integer',
    ];


    public function assignedUser()
    {
        return $this->belongsTo(
            User::class,
            'assigned_to'
        );
    }
}
