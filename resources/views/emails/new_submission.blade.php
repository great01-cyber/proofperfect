@component('mail::message')
# New Submission Received

**Email:** {{ $submission->email }}
**Document Type:** {{ $submission->document_type }}
**Google Doc Link:** [Open Document]({{ $submission->google_doc_link }})

@if($submission->focus_notes)
**Focus Notes:**
{{ $submission->focus_notes }}
@endif

Thanks,<br>
Your App
@endcomponent
