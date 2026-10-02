<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouthMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'message',
        'category',
        'audio_path',

        'wants_callback',
        'callback_channel',
        'contact',
        'callback_time',

        'source_channel',

        'qualification',
        'internal_summary',
        'action_taken',
        'follow_up',
        'status',

        'assigned_to',
    ];

    protected $casts = [
        'wants_callback' => 'boolean',
    ];

    /**
     * Utilisateur YOULIDA responsable du suivi.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
