<?php

namespace App\Http\Controllers;

use App\Mail\MarketingEmail;
use Illuminate\Http\Request;
use Swift_TransportException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class MarketingEmailController extends Controller
{

    public function send(Request $request)
    {
        try {
            // Log incoming request data
            Log::info('Incoming request data:', $request->all());

            // Validate required fields
            $request->validate([
                'example-email' => 'required|string', // Initial validation to check the presence of the field
                'example-subject' => 'required|string',
                'body' => 'required|string',
                'files.*' => 'file|max:2048|mimes:jpg,jpeg,png,pdf,docx', // Restrict file types
            ]);

            Log::info('Initial validation passed');

            // Retrieve the form data
            $to = $request->input('example-email');
            $subject = $request->input('example-subject');
            $body = $request->input('body');

            // Process and validate emails
            $toEmails = array_map('trim', explode(',', $to));
            $invalidEmails = array_filter($toEmails, function ($email) {
                return !filter_var($email, FILTER_VALIDATE_EMAIL); // Check for invalid email addresses
            });

            if (count($invalidEmails) > 0) {
                Log::error('Invalid email addresses found:', $invalidEmails);

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email addresses detected.',
                    'invalidEmails' => $invalidEmails,
                ], 422);
            }

            Log::info('All email addresses are valid:', $toEmails);

            // Retrieve the uploaded files, defaulting to an empty array if none are provided
            $attachments = $request->file('files', []);

            // Process attachments
            $attachmentPaths = [];
            foreach ($attachments as $file) {
                $path = $file->storeAs('public/attachments', $file->getClientOriginalName());
                $attachmentPaths[] = storage_path('app/' . $path);
            }

            // Initialize success and failed email arrays
            $failedEmails = [];
            $successfulEmails = [];

            // Attempt to send email to each recipient
            foreach ($toEmails as $email) {
                try {
                    if (count($attachmentPaths) > 0) {
                        Mail::to($email)->send(new MarketingEmail($subject, $body, $attachmentPaths));
                    } else {
                        Mail::to($email)->send(new MarketingEmail($subject, $body));
                    }
                    $successfulEmails[] = $email;
                } catch (\Exception $e) {
                    Log::error('Failed to send email to:', ['email' => $email, 'error' => $e->getMessage()]);
                    $failedEmails[] = $email;
                }
            }

            // Prepare the response message
            $message = 'Email processing completed.';
            if (count($failedEmails) > 0) {
                $message .= ' Some emails failed to send.';
            }

            // Return the response
            if (count($failedEmails) > 0) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'failedEmails' => $failedEmails,
                ], 422);
            }

            return response()->json([
                'success' => true,
                'message' => 'Emails sent successfully.',
                'successfulEmails' => $successfulEmails,
            ]);

        } catch (ValidationException $e) {
            Log::error('Validation failed:', ['errors' => $e->errors()]);

            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);

        } catch (Swift_TransportException $e) {
            Log::error('TCP Port Error:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to the email server. Please check the server or TCP port settings.',
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending email:', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again later.',
            ]);
        }
    }




}
