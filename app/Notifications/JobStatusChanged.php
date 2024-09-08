<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use App\Models\Job;

class JobStatusChanged extends Notification
{
    use Queueable;

    protected $job;
    protected $newStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(Job $job, string $newStatus)
    {
        $this->job = $job;
        $this->newStatus = $newStatus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(mixed $notifiable): array
    {
        return ['mail', 'database']; // Send via email and save to database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Job Status Has Been Updated')
            ->line("The status of your job posting '{$this->job->title}' has been updated to: {$this->newStatus}.")
            ->action('View Job Posting', url(route('jobs.index')))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification for database storage.
     */
    public function toDatabase(mixed $notifiable): array
    {
        return [
            'job_id' => $this->job->id,
            'job_title' => $this->job->title,
            'new_status' => $this->newStatus,
            'message' => "Your job '{$this->job->title}' status has been updated to: {$this->newStatus}."
        ];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'job_id' => $this->job->id,
            'title' => $this->job->title,
            'status' => $this->job->status,
            'message' => 'Your job posting status has been updated to: ' . ucfirst($this->job->status)
        ];
    }
}
