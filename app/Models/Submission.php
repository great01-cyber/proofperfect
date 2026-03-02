<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'email',
        'document_type',
        'google_doc_link',
        'focus_notes',
        'status',
        'admin_notes',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'badge-pending',
            'in_review' => 'badge-review',
            'completed' => 'badge-done',
            default     => 'badge-pending',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'Pending',
            'in_review' => 'In Review',
            'completed' => 'Completed',
            default     => 'Pending',
        };
    }

    public function getDocTypeShortAttribute(): string
    {
        return match($this->document_type) {
            'Assessment / Essay / Coursework' => 'Assessment',
            'Statement of Purpose (SOP)'      => 'SOP',
            'Cover Letter'                    => 'Cover Letter',
            'CV / Résumé'                     => 'CV / Résumé',
            default                           => 'Other',
        };
    }
}
