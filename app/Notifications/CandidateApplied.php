<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CandidateApplied extends Notification
{
    use Queueable;

    protected $candidate;
    protected $job;
    protected $status;

    /**
     * Create a new notification instance.
     */
    public function __construct($candidate, $job)
    {
        $this->candidate = $candidate;
        $this->job = $job;
        $this->status = 'Applying';
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
        return (new MailMessage)
            ->subject('New Job Application')
            ->line("{$this->candidate->name} has applied for the job: {$this->job->title}.")
            ->action('View Application', url(route('jobs.show', $this->job->id)))
            ->line('Please review the application.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "{$this->candidate->name} has applied for the job: {$this->job->title}.",
            'job_title' => $this->job->title,
            'candidate_id' => $this->candidate->id,
        ];
    }
}
