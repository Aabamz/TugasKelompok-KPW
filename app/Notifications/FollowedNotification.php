<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class FollowedNotification extends Notification
{
    use Queueable;

    public function __construct(public User $follower)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database', WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Follower Baru')
            ->icon($this->follower->avatar ? asset('storage/' . $this->follower->avatar) : 'https://i.pravatar.cc/150?u=' . $this->follower->id)
            ->body($this->follower->name . ' mulai mengikuti kamu.')
            ->action('Lihat Profil', 'lihat_profil')
            ->data(['url' => route('profile.view', $this->follower->id)]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'follower_id'   => $this->follower->id,
            'follower_name' => $this->follower->name,
            'follower_avatar' => $this->follower->avatar,
            'message'       => $this->follower->name . ' mulai mengikuti kamu.',
        ];
    }
}
