<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total'      => Submission::count(),
            'pending'    => Submission::where('status', 'pending')->count(),
            'in_review'  => Submission::where('status', 'in_review')->count(),
            'completed'  => Submission::where('status', 'completed')->count(),
            'this_month' => Submission::whereMonth('created_at', now()->month)
                                      ->whereYear('created_at', now()->year)
                                      ->count(),
        ];

        $byType = Submission::select('document_type', DB::raw('count(*) as total'))
            ->groupBy('document_type')
            ->orderByDesc('total')
            ->get();

        $monthly = Submission::select(
                DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month', DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $recent = Submission::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'byType', 'monthly', 'recent'));
    }

    public function index(Request $request)
    {
        $query = Submission::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('document_type', $request->type);
        }

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $submissions = $query->paginate(20)->withQueryString();

        return view('admin.submissions', compact('submissions'));
    }

    public function show(Submission $submission)
    {
        return view('admin.submission-detail', compact('submission'));
    }

    public function update(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'status'      => ['required', 'in:pending,in_review,completed'],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ]);

        if ($validated['status'] === 'completed' && $submission->status !== 'completed') {
            $validated['reviewed_at'] = now();
        }

        $submission->update($validated);

        return redirect()->route('admin.submissions.show', $submission)
            ->with('success', 'Submission updated successfully.');
    }

    public function destroy(Submission $submission)
    {
        $submission->delete();

        return redirect()->route('admin.submissions.index')
            ->with('success', 'Submission deleted.');
    }
}
