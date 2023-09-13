<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JobSeekerAccountSettingsController extends Controller
{
    public function index()
    {
        return view('job_seeker.account_settings');
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        User::where('id',auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect(route('job_seeker.account_settings.index'))->with('success','Password Successfully Changed');
    }
}
