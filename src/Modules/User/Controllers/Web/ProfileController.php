<?php

namespace Modules\User\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Models\User;

class ProfileController extends Controller
{

    public function edit(Request $request)
    {
        if ($request->isMethod('GET')) {
            $user = auth()->user();
            return view('User::edit', get_defined_vars());
        }
        $user = auth()->user();
        $data = $request->validate([
            'mobile' => 'required|unique:users,mobile,' . $user->id,
            'email' => 'required|unique:users,email,' . $user->id,
            'name' => 'required|unique:users,name,' . $user->id,
        ]);
        $user->update($data);
        return back()->with('success', __('Profile edited successfully'));
    }

    public function notifications()
    {
        $user = auth()->user();
        $rows = $user->notifications()->latest()->paginate(20);
        $title = __('Notifications');
        return view("User::notifications", get_defined_vars());
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }
}
