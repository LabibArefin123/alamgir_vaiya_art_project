<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\FrontendSetting;
use App\Models\AboutSection;
use App\Models\ContactCard;
use App\Models\ProjectSection;
use App\Models\SystemProblem;
use App\Models\KeyActivity;
use App\Models\News;
use App\Models\NewsSection;
use App\Models\SkillSection;
use App\Models\Contact;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WelcomePageController extends Controller
{
    public function index()
    {
        $about = AboutSection::where('status', 1)->first();
        $projects = ProjectSection::where('status', 1)->get();
        $newsSection = NewsSection::first();

        $featuredNews = News::where('type', 'featured')
            ->where('status', 1)
            ->latest()
            ->first();

        $listNews = News::where('type', 'list')
            ->where('status', 1)
            ->latest()
            ->take(3)
            ->get();

        $activities = KeyActivity::where('status', 1)
            ->orderBy('serial')
            ->get();


        $skillSection = SkillSection::where('status', 1)->orderBy('serial')->get();

        return view('frontend.welcome', compact(
            'about',
            'projects',
            'newsSection',
            'featuredNews',
            'listNews',
            'activities',
            'skillSection',
        ));
    }

    public function contact()
    {
        $cards = ContactCard::where('status', 1)->get();

        return view('frontend.contact', compact('cards'));
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Thank you! Your message has been sent.');
    }

    public function showProject($id)
    {
        $project = ProjectSection::with('subProjects')
            ->where('status', 1)
            ->findOrFail($id);

        return view('frontend.projects.show', compact('project'));
    }

    public function quote_request_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string',
            'project_type' => 'required|string',
            'message' => 'required|string',
        ]);

        QuoteRequest::create($request->all());

        return back()->with('success', 'Your quote request has been submitted!');
    }

    public function system_problem_store(Request $request)
    {
        $request->validate([
            'problem_title' => 'required|string|max:255',
            'problem_description' => 'required|string',
            'status' => 'required|in:low,medium,high,critical',
            'problem_file' => 'nullable|file|max:4096',
            'multiple_images.*' => 'nullable|image|max:4096',
            'multiple_pdfs.*' => 'nullable|file|max:4096',
        ]);

        $uid = 'TECH-PROB-' . strtoupper(Str::random(6));

        // SINGLE FILE
        $fileName = null;
        if ($request->hasFile('problem_file')) {
            $file = $request->file('problem_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/problem/files'), $fileName);
        }

        // MULTIPLE IMAGES
        $images = [];
        if ($request->hasFile('multiple_images')) {
            foreach ($request->file('multiple_images') as $img) {
                $name = time() . '_' . $img->getClientOriginalName();
                $img->move(public_path('uploads/problem/images'), $name);
                $images[] = $name;
            }
        }

        // MULTIPLE FILES
        $files = [];
        if ($request->hasFile('multiple_pdfs')) {
            foreach ($request->file('multiple_pdfs') as $f) {
                $name = time() . '_' . $f->getClientOriginalName();
                $f->move(public_path('uploads/problem/files'), $name);
                $files[] = $name;
            }
        }

        SystemProblem::create([
            'problem_uid' => $uid,
            'problem_title' => $request->problem_title,
            'problem_description' => $request->problem_description,
            'status' => $request->status,
            'problem_file' => $fileName,
            'multiple_images' => $images,
            'multiple_pdfs' => $files,
        ]);

        return back()->with('success', '✅ Problem submitted successfully!');
    }

    public function updateSettings(Request $request)
    {
        // 🔥 FORCE JSON PARSE (CRITICAL FIX)
        $data = json_decode($request->getContent(), true);

        // Safety fallback (if normal form submit happens)
        if (!$data) {
            $data = $request->all();
        }

        $setting = FrontendSetting::first() ?? new FrontendSetting();

        $setting->theme_color   = $data['theme_color'] ?? $setting->theme_color;
        $setting->text_size     = $data['text_size'] ?? $setting->text_size;

        $setting->navbar_layout = $data['navbar_layout'] ?? ($setting->navbar_layout ?? 1);
        $setting->about_layout  = $data['about_layout'] ?? ($setting->about_layout ?? 1);
        $setting->footer_layout = $data['footer_layout'] ?? ($setting->footer_layout ?? 1);

        $setting->animations  = isset($data['animations']) ? (int)$data['animations'] : 0;
        $setting->back_to_top = isset($data['back_to_top']) ? (int)$data['back_to_top'] : 0;
        $setting->dark_mode   = isset($data['dark_mode']) ? (int)$data['dark_mode'] : 0;

        $setting->save();

        // 🔥 DEBUG LOG (CHECK storage/logs/laravel.log)
        \Log::info('Settings Saved:', $data);

        return response()->json([
            'status' => true,
            'message' => 'Settings updated successfully',
            'data' => $setting
        ]);
    }
}
