<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobSeeker\StoreEducationRequest;
use App\Http\Requests\JobSeeker\StoreResumeRequest;
use App\Http\Requests\JobSeeker\StoreSkillRequest;
use App\Http\Requests\JobSeeker\UpdateEducationRequest;
use App\Http\Requests\JobSeeker\UpdateProfileRequest;
use App\Models\JobSeeker;
use App\Models\Skill;
use App\Models\User;


class JobSeekerProfileController extends Controller
{
    public function index()
    {
        $auth_resumes = auth()->user()->jobSeeker->getMedia('resumes');

        $highest_education = JobSeeker::select('highest_education', 'date_graduated', 'field_of_study', 'school_name')->where('user_id', auth()->user()->id)->whereNotNull('highest_education')->get();


        return view('job_seeker.profile', compact('auth_resumes', 'highest_education'));
    }

    public function updateProfile(UpdateProfileRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number
        ]);

        return redirect()->back()->with('success', 'Profile Successfully Updated');
    }

    public function addEducation(StoreEducationRequest $request)
    {
        auth()->user()->jobSeeker->update([
            'highest_education' => $request->highest_education,
            'date_graduated' => $request->date_graduated,
            'field_of_study' => $request->field_of_study,
            'school_name' => $request->school_name
        ]);

        return redirect(route('job_seeker.profile.index'))->with('success', 'Education Successfully Added');
    }

    public function updateEducation(UpdateEducationRequest $request, User $user)
    {
        $user->jobSeeker->update([
            'highest_education' => $request->highest_education,
            'date_graduated' => $request->date_graduated,
            'field_of_study' => $request->field_of_study,
            'school_name' => $request->school_name
        ]);

        return redirect(route('job_seeker.profile.index'))->with('success', 'Education Successfully Updated');
    }

    public function addSkill(StoreSkillRequest $request, User $user)
    {
        $skill_count = Skill::where('job_seeker_id', $user->jobSeeker->id)->count();

        if ($skill_count >= 5) {
            return redirect(route('job_seeker.profile.index'))->with('error', 'You reach maximum skill count');
        }

        Skill::create([
            'job_seeker_id' => $user->jobSeeker->id,
            'name' => $request->skill
        ]);

        return redirect(route('job_seeker.profile.index'))->with('success', 'Skill Successfully Added');
    }

    public function deleteSkill(Skill $skill)
    {
        $skill->delete();

        return redirect(route('job_seeker.profile.index'))->with('success', 'Skill Successfully Deleted');
    }

    public function addResume(StoreResumeRequest $request, User $user)
    {

        $user->jobSeeker->update([
            'resume_file_path' => $request->resume
        ]);


        if ($request->hasFile('resume')) {
            $user->jobSeeker->addMediaFromRequest('resume')->toMediaCollection('resumes');
        }

        return redirect()->route('job_seeker.profile.index')->with('success', 'Resume Successfully Added');
    }
}
