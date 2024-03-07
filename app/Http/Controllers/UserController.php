<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('pages.update-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        if ($request->filled(['current_password', 'new_password', 'confirm_password'])) {
            // Validate current password
            if (!Hash::check($request->input('current_password'), $user->password)) {
                return redirect()->back()->with('error', 'Current password is incorrect.');
            }

            $request->validate([
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user->update([
                'password' => bcrypt($request->input('new_password')),
            ]);
        }

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function destroy($id)
    {
        $user = User::find($request->user_id);
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
    public function update_user_role(Request $request)
    {
        $user = User::find($request->user_id);
        $role = Role::where('name', $request->updated_role)->first();
        if ($user && $role) {
            $user->syncRoles([$role->id]);
            return back()->with('success', 'User role updated successfully.');
        } else
            return back()->with('error', 'Something went wrong try again !!!');
    }
}
