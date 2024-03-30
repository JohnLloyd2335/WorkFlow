<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminUserManagementController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $users = User::whereHas('role', function ($query) {
                $query->whereIn('role', [2, 3]);
            })->orderByDesc('id')->get();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('role', function ($user) {
                    return ($user->role->role == 2 ? 'Employer' : 'JobSeeker');
                })
                ->addColumn('action', function ($user) {
                    return " <div class='d-flex align-items-center justify-content-center'><a href='" . route('admin.manage_users.edit', $user) . "' class='btn btn-primary btn-sm'><span class='mdi mdi-pencil'></span></a></div>";
                })
                ->rawColumns(['role', 'action'])
                ->make(true);
        }

        return view('admin.manage_users.index');
    }

    public function edit(User $user)
    {
        return view('admin.manage_users.edit', compact('user'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number
        ]);

        return redirect(route('admin.manage_users.index'))->with('success', 'User Successfully Updated');
    }
}
