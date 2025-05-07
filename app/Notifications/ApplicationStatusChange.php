<?php

namespace App\Notifications;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusChange extends Notification
{
    use Queueable;
    public $application;

    /**
     * Create a new notification instance.
     */
    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Job Application Status Updated')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your application for "' . $this->application->jobPost->title . '" has been ' . $this->application->status . '.')
            ->action('View Application', url('/jobseeker/applications'))
            ->line('Thank you for using our platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'job_post_title' => $this->application->jobPost->title,
            'status' => $this->application->status,
            'job_post_id' => $this->application->jobPost->id,
        ];
    }
}
