<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatus extends Notification
{
    use Queueable;
    protected $job;
    protected $status;
    /**
     * Create a new notification instance.
     */
    public function __construct($job, $status)
    {
        $this->job = $job;
        $this->status = $status;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database']; // Sends via email and stores in the database for in-app notifications
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = new MailMessage();
        $jobTitle = $this->job->title;

        if ($this->status === 'approved') {
            $mailMessage->subject('Application Approved')
                ->line("Your application for the job '{$jobTitle}' has been approved.")
                ->action('View Job', url(route('jobs.show', $this->job->id)))
                ->line('Congratulations!');
        } else {
            $mailMessage->subject('Application Rejected')
                ->line("Your application for the job '{$jobTitle}' has been rejected.")
                ->line('We encourage you to apply for other opportunities on our platform.');
        }

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $message = $this->status === 'approved'
            ? "Your application for the job '{$this->job->title}' has been approved."
            : "Your application for the job '{$this->job->title}' has been rejected.";

        return [
            'message' => $message,
            'job_id' => $this->job->id,
            'job_title' => $this->job->title,
            'status' => $this->status,
        ];
    }
}
