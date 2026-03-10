<!DOCTYPE html>
<html>
<body style="font-family: Arial, sans-serif; padding: 30px; color: #333;">

    <h2 style="color: #1B2E4B;">New Submission Received</h2>

    <p><strong>Email:</strong> {{ $submission->email }}</p>
    <p><strong>Document Type:</strong> {{ $submission->document_type }}</p>
    <p><strong>Google Doc Link:</strong>
        <a href="{{ $submission->google_doc_link }}">Open Document</a>
    </p>

    @if($submission->focus_notes)
    <p><strong>Focus Notes:</strong><br>
        {{ $submission->focus_notes }}
    </p>
    @endif

    <hr style="margin-top: 30px;">
    <p style="color: #999; font-size: 12px;">Your App</p>

</body>
</html>
