<?php

namespace App\Http\Controllers;

use App\Mail\NewSubmissionMail;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email'           => ['required', 'email', 'max:255'],
            'document_type'   => ['required', 'string', 'max:100'],
            'google_doc_link' => ['required', 'url', 'max:1000'],
            'focus_notes'     => ['nullable', 'string', 'max:2000'],
        ]);

        // 1. Save to Database
        $submission = Submission::create($validated);

        // 2. Attempt to Send Mail
        try {
            Mail::to('greatjohn088@yahoo.com')->send(new NewSubmissionMail($submission));

            return response()->json([
                'success' => true,
                'message' => 'Submission received! You will hear back within 48 hours.',
            ]);

        } catch (\Exception $e) {
            // Log the error so you can see the full stack trace in Laravel Cloud logs
            Log::error('Mail Sending Failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Submission saved, but email notification failed.',
                'error'   => $e->getMessage() // This helps you debug the SMTP issue
            ], 500);
        }
    }
}
