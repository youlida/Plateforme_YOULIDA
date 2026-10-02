<?php

namespace App\Notifications;

use App\Models\InterventionRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewInterventionRequestNotification extends Notification
{
    use Queueable;

    public function __construct(
        public InterventionRequest $interventionRequest
    ) {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'intervention_request',
            'title' => 'Nouvelle demande d’intervention',
            'message' => 'Une nouvelle demande d’intervention a été reçue.',
            'reference' => $this->interventionRequest->reference,
            'intervention_request_id' => $this->interventionRequest->id,

            'url' => route(
                'admin.intervention-requests.show',
                $this->interventionRequest
            ),
        ];
    }
}
