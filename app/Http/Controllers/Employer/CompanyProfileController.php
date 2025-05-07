<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->companyProfile ?? new CompanyProfile();

        return view('employer.company_profile.edit', compact('profile', 'user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $data['logo'] = $logoPath;
        }
        /** @var \App\Models\User $user */

        $user = Auth::user();
        $user->load(['jobPosts', 'companyProfile']);

        $user->companyProfile()->updateOrCreate(['user_id' => $user->id], $data);

        return redirect()->route('employer.dashboard')->with('status', 'Company profile updated successfully!');
    }
}
