<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resume = Auth::user()->resume;
        return view('jobseeker.resume.index', compact('resume'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobseeker.resume.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'resume_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
        ]);

        $filePath = $request->file('resume_file')->store('resumes');

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->load(['resume']);

        $user->resume()->create([
            'file_path' => $filePath,
            'skills' => $request->skills,
            'experience' => $request->experience,
            'education' => $request->education,
        ]);

        return redirect()->route('jobseeker.resume.index')
            ->with('success', 'Resume uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resume = Auth::user()->resume;
        return view('jobseeker.resume.edit', compact('resume'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'education' => 'nullable|string',
        ]);

        $resume = Auth::user()->resume;
        $data = [
            'skills' => $request->skills,
            'experience' => $request->experience,
            'education' => $request->education,
        ];

        if ($request->hasFile('resume_file')) {
            Storage::delete($resume->file_path);
            $data['file_path'] = $request->file('resume_file')->store('resumes');
        }

        $resume->update($data);

        return redirect()->route('jobseeker.resume.index')
            ->with('success', 'Resume updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resume = Resume::findOrFail($id);
        Storage::delete($resume->file_path);
        $resume->delete();

        return redirect()->route('jobseeker.resume.index')
            ->with('success', 'Resume deleted successfully!');
    }
}
