<?php

namespace App\Notifications;

use App\Models\Benevole;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewBenevoleNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Benevole $benevole
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
            'type' => 'benevole',
            'title' => 'Nouvelle candidature bénévole',
            'message' => 'Une nouvelle candidature de bénévolat a été reçue.',
            'benevole_id' => $this->benevole->id,
            'url' => route(
                'admin.benevoles.show',
                $this->benevole
            ),
        ];
    }
}
