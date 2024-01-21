<?php

namespace Modules\User\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Modules\User\Controllers\ConfirmationCode;
use Modules\User\Models\User;
use Modules\User\Requests\LoginRequest;
use Modules\User\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("User::auth.login");
        }
        app(LoginRequest::class);
        if ($request->type == 'visitor') {
            return $this->visitor();
        }
        return $this->owner();
    }

    public function visitor()
    {
        $user = User::firstOrCreate(['mobile' => request('mobile'), 'type' => 'visitor']);
        $code = ConfirmationCode::send($user);
        return redirect()->route('activate', Crypt::encrypt($user->mobile));
    }

    public function owner()
    {
        if (auth()->attempt(request(['name', 'password']), true)) {
            return redirect()->to('/');
        }
        return back()->with('error', __('Invalid username or password'));
    }

    public function activate(Request $request, $mobile)
    {
        if ($request->isMethod('GET')) {
            $mobile = Crypt::decrypt($mobile);
            return view("User::auth.activate", get_defined_vars());
        }
        $user = User::where('mobile', Crypt::decrypt($mobile))->firstOrFail();
        $code = implode('', $request->code);
        $code = $user->token()->where('token', $code)->first();
        if (!$code) {
            return back()->with('error', __('Not correct confirmation code'));
        }
        auth()->login($user);
        return redirect()->to('/');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('User::auth.register');
        }
        app(RegisterRequest::class);
        $data = $request->all();
        $data['type'] = 'renter_owner';
        $user = User::create($data);
        $code = ConfirmationCode::send($user);
        return redirect()->route('activate', Crypt::encrypt($user->mobile));
    }
}
