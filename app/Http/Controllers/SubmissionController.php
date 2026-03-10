<?php

namespace App\Http\Controllers;

use App\Mail\NewSubmissionMail;
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

    // Send email to your personal Gmail
    Mail::to('greatujah088@gmail.com')->send(
        new NewSubmissionMail($submission)
    );

    return response()->json([
        'success' => true,
        'message' => 'Submission received! You will hear back within 48 hours.',
    ]);
    }
}

