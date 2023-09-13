<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployerAccountSettingsController extends Controller
{
    public function index()
    {
        return view('employer.account_settings');
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        User::where('id',auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect(route('employer.account_settings.index'))->with('success','Password Successfully Changed');
    }
}
