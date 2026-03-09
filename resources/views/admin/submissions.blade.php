@extends('admin.layout')
@section('title', 'Submissions')
@section('page-title', 'All Submissions')

@section('content')

{{-- FILTERS --}}
<form method="GET" action="{{ route('admin.submissions.index') }}">
    <div class="form-row">
        <div class="form-group">
            <label>Search Email</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="student@email.com">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status">
                <option value="">All Statuses</option>
                <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="in_review" {{ request('status') === 'in_review' ? 'selected' : '' }}>In Review</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="form-group">
            <label>Document Type</label>
            <select name="type">
                <option value="">All Types</option>
                <option value="Assessment / Essay / Coursework" {{ request('type') === 'Assessment / Essay / Coursework' ? 'selected' : '' }}>Assessment</option>
                <option value="Statement of Purpose (SOP)"      {{ request('type') === 'Statement of Purpose (SOP)'      ? 'selected' : '' }}>SOP</option>
                <option value="Cover Letter"                    {{ request('type') === 'Cover Letter'                    ? 'selected' : '' }}>Cover Letter</option>
                <option value="CV / Résumé"                     {{ request('type') === 'CV / Résumé'                     ? 'selected' : '' }}>CV / Résumé</option>
                <option value="Other"                           {{ request('type') === 'Other'                           ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-group" style="justify-content: flex-end;">
            <label>&nbsp;</label>
            <div style="display:flex; gap:0.5rem;">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.submissions.index') }}" class="btn btn-ghost">Reset</a>
            </div>
        </div>
    </div>
</form>

<div class="table-wrap">
    <div class="table-header">
        <h3>{{ $submissions->total() }} submission{{ $submissions->total() !== 1 ? 's' : '' }}</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Document Type</th>
                <th>Google Doc</th>
                <th>Status</th>
                <th>Submitted</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $s)
                <tr>
                    <td style="color:#aaa; font-size:0.8rem;">{{ $s->id }}</td>
                    <td><strong>{{ $s->email }}</strong></td>
                    <td style="font-size:0.83rem;">{{ $s->doc_type_short }}</td>
                    <td>
                        <a href="{{ $s->google_doc_link }}" target="_blank" class="btn btn-ghost btn-sm" style="font-size:0.75rem;">
                            Open Doc ↗
                        </a>
                    </td>
                    <td>
                        <span class="badge badge-{{ $s->status === 'in_review' ? 'review' : ($s->status === 'completed' ? 'done' : 'pending') }}">
                            {{ $s->status_label }}
                        </span>
                    </td>
                    <td style="color:#888; font-size:0.8rem;">{{ $s->created_at->format('d M Y, H:i') }}</td>
                    <td><a href="{{ route('admin.submissions.show', $s) }}" class="btn btn-primary btn-sm">Review</a></td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center; color:#aaa; padding:2.5rem;">No submissions match your filters.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($submissions->hasPages())
        <div style="padding: 1rem 1.4rem; border-top: 1px solid #f0e8d8;">
            {{ $submissions->links() }}
        </div>
    @endif
</div>

@endsection
