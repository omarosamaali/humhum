<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\ChefProfile;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportResponseMail;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'chefProfile.user'])->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $report->load(['user', 'chefProfile.user']);
        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'تم حذف البلاغ بنجاح.');
    }

    public function store(Request $request, ChefProfile $chefProfile)
    {
        $request->validate([
            'report_type' => 'required|in:content_report,fake_account'
        ]);

        $existingReport = Report::where('user_id', auth()->id())
            ->where('chef_profile_id', $chefProfile->id)
            ->first();

        if ($existingReport) {
            return response()->json([
                'success' => false,
                'message' => 'لقد قمت بالإبلاغ عن هذا الحساب من قبل'
            ]);
        }

        $report = Report::create([
            'user_id' => auth()->id(),
            'report_type' => $request->report_type,
            'chef_profile_id' => $chefProfile->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم إرسال البلاغ بنجاح'
        ]);
    }

    public function sendMessage(Request $request, Report $report)
    {
        $request->validate([
            'message' => 'required|string|min:10|max:1000',
        ]);

        // Ensure the user exists
        if (!$report->user || !$report->user->email) {
            \Log::error('User not found or no email for report ID: ' . $report->id);
            return redirect()->back()->with('error', 'لا يمكن إرسال الرسالة: المستخدم غير موجود أو لا يملك بريدًا إلكترونيًا.');
        }

        // Send email to the user
        try {
            \Log::info('Attempting to send email to: ' . $report->user->email . ', Message: ' . $request->message);
            Mail::to($report->user->email)->send(new ReportResponseMail($report, $request->message));
            \Log::info('Email sent to: ' . $report->user->email);
            return redirect()->back()->with('success', 'تم إرسال الرسالة بنجاح.');
        } catch (\Exception $e) {
            \Log::error('Failed to send report response email: ' . $e->getMessage());
            return redirect()->back()->with('error', 'فشل إرسال الرسالة. حاول مرة أخرى لاحقًا.');
        }
    }
}
