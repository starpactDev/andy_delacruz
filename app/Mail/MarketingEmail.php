<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\UploadedFile;

class MarketingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $subject;
    public $attachments;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $body
     * @param array $attachments
     */
    public function __construct($subject, $body, $attachments = [])
    {
        $this->subject = $subject;
        $this->body = $body;
    
        // Normalize all attachments to an array format
        $this->attachments = array_map(function ($attachment) {
            return is_string($attachment) ? ['file' => $attachment, 'options' => []] : $attachment;
        }, $attachments);
    }
    
    public function build()
    {
        Log::info('Attachments in build method:', ['attachments' => $this->attachments]);

        $email = $this->subject($this->subject)
                      ->view('emails.marketing')
                      ->with(['body' => $this->body]);
    
        // Ensure attachments are attached correctly
        foreach ($this->attachments as $attachment) {
            // If $attachment is a string (file path), attach it directly
            if (is_string($attachment)) {
                $email->attach($attachment);
            } elseif (is_array($attachment) && isset($attachment['file'])) {
                // If $attachment is an array with 'file' and 'options', use those
                $email->attach($attachment['file'], $attachment['options'] ?? []);
            }
        }
    
        return $email;
    }
    
    
    

    /**
     * Helper function to extract file path from file or UploadedFile.
     *
     * @param mixed $file
     * @return string|null
     */
    private function getFilePath($file)
    {
        // If it's an UploadedFile instance, return its real path
        if ($file instanceof UploadedFile) {
            return $file->getRealPath();
        }

        // If it's a string (path), return it directly
        if (is_string($file)) {
            return $file;
        }

        return null; // Return null if neither
    }
}
