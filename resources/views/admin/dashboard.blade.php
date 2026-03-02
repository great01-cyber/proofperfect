@extends('admin.layout')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- HEADLINE STATS --}}
<div class="stat-grid">
    <div class="stat-card gold">
        <div class="stat-icon">📄</div>
        <div class="stat-label">Total Submissions</div>
        <div class="stat-value">{{ $stats['total'] }}</div>
    </div>
    <div class="stat-card orange">
        <div class="stat-icon">⏳</div>
        <div class="stat-label">Pending Review</div>
        <div class="stat-value">{{ $stats['pending'] }}</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon">🔍</div>
        <div class="stat-label">In Review</div>
        <div class="stat-value">{{ $stats['in_review'] }}</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">✅</div>
        <div class="stat-label">Completed</div>
        <div class="stat-value">{{ $stats['completed'] }}</div>
    </div>
    <div class="stat-card rust">
        <div class="stat-icon">📅</div>
        <div class="stat-label">This Month</div>
        <div class="stat-value">{{ $stats['this_month'] }}</div>
    </div>
</div>

{{-- CHARTS ROW --}}
<div class="charts-row">

    <div class="chart-card">
        <h3>📋 Submissions by Document Type</h3>
        @php $maxType = $byType->max('total') ?: 1; @endphp
        <div class="bar-list">
            @forelse($byType as $type)
                @php
                    $short = match($type->document_type) {
                        'Assessment / Essay / Coursework' => 'Assessment',
                        'Statement of Purpose (SOP)'      => 'SOP',
                        'Cover Letter'                    => 'Cover Letter',
                        'CV / Résumé'                     => 'CV / Résumé',
                        default                           => 'Other',
                    };
                @endphp
                <div class="bar-item">
                    <label><span>{{ $short }}</span><span><strong>{{ $type->total }}</strong></span></label>
                    <div class="bar-track">
                        <div class="bar-fill" style="width: {{ round(($type->total / $maxType) * 100) }}%"></div>
                    </div>
                </div>
            @empty
                <p style="color:#aaa; font-size:0.85rem;">No submissions yet.</p>
            @endforelse
        </div>
    </div>

    <div class="chart-card">
        <h3>📈 Submissions per Month (Last 6)</h3>
        @php $maxMonth = $monthly->max('total') ?: 1; @endphp
        <div class="month-chart">
            @forelse($monthly as $m)
                <div class="month-col">
                    <div class="month-val">{{ $m->total }}</div>
                    <div class="month-bar" style="height: {{ round(($m->total / $maxMonth) * 80) + 4 }}px"></div>
                    <div class="month-label">{{ $m->month }}</div>
                </div>
            @empty
                <p style="color:#aaa; font-size:0.85rem; align-self:center;">No data yet.</p>
            @endforelse
        </div>
    </div>

</div>

{{-- RECENT SUBMISSIONS --}}
<div class="table-wrap">
    <div class="table-header">
        <h3>🕐 Recent Submissions</h3>
        <a href="{{ route('admin.submissions.index') }}" class="btn btn-ghost btn-sm">View all →</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Document Type</th>
                <th>Status</th>
                <th>Submitted</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($recent as $s)
                <tr>
                    <td style="color:#aaa; font-size:0.8rem;">{{ $s->id }}</td>
                    <td><strong>{{ $s->email }}</strong></td>
                    <td>{{ $s->doc_type_short }}</td>
                    <td>
                        <span class="badge badge-{{ $s->status === 'in_review' ? 'review' : ($s->status === 'completed' ? 'done' : 'pending') }}">
                            {{ $s->status_label }}
                        </span>
                    </td>
                    <td style="color:#888; font-size:0.82rem;">{{ $s->created_at->diffForHumans() }}</td>
                    <td><a href="{{ route('admin.submissions.show', $s) }}" class="btn btn-ghost btn-sm">Open</a></td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center; color:#aaa; padding:2rem;">No submissions yet. Share the site!</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
