<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAccountSettingsController extends Controller
{
    public function index()
    {
        return view('admin.account_settings');
    }

    public function changePassword(UpdatePasswordRequest $request)
    {
        User::where('id',auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect(route('admin.account_settings.index'))->with('success','Password Successfully Changed');
    }
}
