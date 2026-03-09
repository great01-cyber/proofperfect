@extends('admin.layout')
@section('title', 'Submission #' . $submission->id)
@section('page-title', 'Submission #' . $submission->id)

@section('content')

<div class="page-actions" style="margin-bottom:1.5rem;">
    <a href="{{ route('admin.submissions.index') }}" class="btn btn-ghost">← Back to list</a>
    <form method="POST" action="{{ route('admin.submissions.destroy', $submission) }}"
          onsubmit="return confirm('Delete this submission permanently?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">🗑 Delete</button>
    </form>
</div>

<div style="display: grid; grid-template-columns: 1fr 380px; gap: 1.5rem; align-items: start;">

    {{-- LEFT: Details --}}
    <div>
        <div class="detail-card">
            <div class="detail-card-header">Submission Details</div>
            <div class="detail-card-body">
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value">
                        <a href="mailto:{{ $submission->email }}">{{ $submission->email }}</a>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Document Type</span>
                    <span class="detail-value">{{ $submission->document_type }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Google Doc Link</span>
                    <span class="detail-value">
                        <a href="{{ $submission->google_doc_link }}" target="_blank">
                            Open in Google Docs ↗
                        </a>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Submitted</span>
                    <span class="detail-value">{{ $submission->created_at->format('d F Y, H:i') }} ({{ $submission->created_at->diffForHumans() }})</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Current Status</span>
                    <span class="detail-value">
                        <span class="badge badge-{{ $submission->status === 'in_review' ? 'review' : ($submission->status === 'completed' ? 'done' : 'pending') }}">
                            {{ $submission->status_label }}
                        </span>
                    </span>
                </div>
                @if($submission->reviewed_at)
                <div class="detail-row">
                    <span class="detail-label">Completed At</span>
                    <span class="detail-value">{{ $submission->reviewed_at->format('d F Y, H:i') }}</span>
                </div>
                @endif
            </div>
        </div>

        @if($submission->focus_notes)
        <div class="detail-card">
            <div class="detail-card-header">Student's Focus Notes</div>
            <div class="detail-card-body">
                <div class="detail-notes">{{ $submission->focus_notes }}</div>
            </div>
        </div>
        @endif

        @if($submission->admin_notes)
        <div class="detail-card">
            <div class="detail-card-header">Your Admin Notes</div>
            <div class="detail-card-body">
                <div class="detail-notes">{{ $submission->admin_notes }}</div>
            </div>
        </div>
        @endif
    </div>

    {{-- RIGHT: Update Status --}}
    <div>
        <div class="detail-card">
            <div class="detail-card-header">Update Status</div>
            <div class="detail-card-body">
                <form method="POST" action="{{ route('admin.submissions.update', $submission) }}">
                    @csrf @method('PATCH')

                    <div class="form-group" style="margin-bottom:1rem;">
                        <label>Status</label>
                        <select name="status">
                            <option value="pending"   {{ $submission->status === 'pending'   ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="in_review" {{ $submission->status === 'in_review' ? 'selected' : '' }}>🔍 In Review</option>
                            <option value="completed" {{ $submission->status === 'completed' ? 'selected' : '' }}>✅ Completed</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom:1rem;">
                        <label>Private Notes (only you see this)</label>
                        <textarea name="admin_notes" placeholder="e.g. Fixed grammar in intro, tightened SOP conclusion, flagged passive voice throughout...">{{ $submission->admin_notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-gold" style="width:100%;">Save Changes</button>
                </form>

                <div style="margin-top: 1.2rem; padding-top: 1.2rem; border-top: 1px solid #f0e8d8;">
                    <p style="font-size:0.78rem; color:#aaa; margin-bottom:0.6rem;">Quick action:</p>
                    <a href="{{ $submission->google_doc_link }}" target="_blank" class="btn btn-primary" style="width:100%; text-align:center; display:block;">
                        📝 Open Google Doc to Review
                    </a>
                    <a href="mailto:{{ $submission->email }}?subject=Your document feedback — ProofPerfect&body=Hi there,%0A%0AI've reviewed your {{ $submission->doc_type_short }} and left comments directly in your Google Doc.%0A%0APlease open the link you shared with me to see the feedback.%0A%0AAll the best,%0AUjah John"
                       class="btn btn-ghost" style="width:100%; text-align:center; display:block; margin-top:0.6rem;">
                        ✉️ Email Student
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
