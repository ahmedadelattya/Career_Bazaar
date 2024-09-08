<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobStatusNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    // public function __construct()
    // {
    //     //
    // }

    // /**
    //  * Get the notification's delivery channels.
    //  *
    //  * @return array<int, string>
    //  */
    // public function via(object $notifiable): array
    // {
    //     return ['mail'];
    // }

    // /**
    //  * Get the mail representation of the notification.
    //  */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @return array<string, mixed>
    //  */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
    protected $job;
    protected $status;

    public function __construct($job, $status)
    {
        $this->job = $job;
        $this->status = $status;
    }

    /**
     * Determine the channels to send the notification.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // Sends via email and stores in the database for in-app notifications
    }

    /**
     * Email notification structure.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Job Status: ' . ucfirst($this->status))
            ->line('The job titled "' . $this->job->title . '" has been ' . $this->status . '.')
            ->action('View Job', url('/jobs/' . $this->job->id))
            ->line('Thank you for using our platform!');
    }

    /**
     * Structure for database notification.
     */
    public function toArray($notifiable)
    {
        return [
            'job_id' => $this->job->id,
            'job_title' => $this->job->title,
            'status' => $this->status,
        ];
    }
}
