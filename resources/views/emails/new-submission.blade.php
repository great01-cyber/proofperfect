<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="font-family: sans-serif; color: #333; max-width: 600px; margin: 0 auto; padding: 2rem;">
    <h2 style="color: #c9952a;">📄 New Proofreading Submission</h2>
    <hr style="border: 1px solid #eee;">

    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Document Type:</strong> {{ $submission->document_type }}</p>
    <p><strong>Google Doc:</strong> <a href="{{ $submission->google_doc_link }}">{{ $submission->google_doc_link }}</a></p>

    @if($submission->focus_notes)
    <p><strong>Focus Notes:</strong><br>{{ $submission->focus_notes }}</p>
    @endif

    <hr style="border: 1px solid #eee;">
    <p style="font-size: 0.85rem; color: #999;">Submitted via ProofPerfect</p>
</body>
</html>
