<?php

namespace App\Http\Controllers;

use App\Mail\NewSubmissionMail;
use App\Mail\SubmissionConfirmationMail;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $submission = Submission::create($validated);

        // Email you (Ujah John) about the new submission
        Mail::to(config('proofperfect.admin_email'))->send(
            new NewSubmissionMail($submission)
        );

        // Send confirmation to the student
        Mail::to($submission->email)->send(
            new SubmissionConfirmationMail($submission)
        );

        return response()->json([
            'success' => true,
            'message' => 'Submission received! You will hear back within 48 hours.',
        ]);
    }
}
