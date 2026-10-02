<?php

namespace App\Notifications;

use App\Models\PartnershipRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewPartnershipRequestNotification extends Notification
{
    use Queueable;

    public function __construct(
        public PartnershipRequest $partnershipRequest
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
            'type' => 'partnership_request',
            'title' => 'Nouvelle demande de partenariat',
            'message' => 'Une nouvelle proposition de partenariat a été reçue.',
            'reference' => $this->partnershipRequest->reference,
            'partnership_request_id' => $this->partnershipRequest->id,

            'url' => route(
                'admin.partnership-requests.show',
                $this->partnershipRequest
            ),
        ];
    }
}
