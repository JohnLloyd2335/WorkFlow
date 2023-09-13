<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employer\UpdateCompanyProfileRequest;
use App\Http\Requests\Employer\UpdateProfileRequest;
use App\Models\User;


class EmployerProfileController extends Controller
{
    public function index()
    {
        return view('employer.profile');
    }

    public function updateProfile(User $user, UpdateProfileRequest $request){

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number
        ]);

        return redirect()->back()->with('success','Profile Successfully Updated');
    }

    public function updateCompanyProfile(User $user, UpdateCompanyProfileRequest $request)
    {
        $user->employer->update([
            'company_name' => $request->company_name,
            'company_description' => $request->company_description,
            'services' => $request->services
        ]);

        return redirect(route('employer.profile.index'))->with('success','Profile Successfully Updated');
    }
}
