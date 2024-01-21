<?php

namespace Modules\User\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view("User::owner.payments.index", get_defined_vars());
    }

    public function pay(Request $request, $id)
    {
        if ($request->isMethod('GET')) {
            return view("User::owner.payments.form", get_defined_vars());
        }
        $request->validate([
            'date' => 'required',
            'image' => 'required|image'
        ]);
        $user = auth()->user();
        $payment = $user->payments()->findOrFail(Crypt::decrypt($id));
        $payment->transfer()->create([
            'user_id' => $user->id,
            'date' => $request->date,
            'image' => $request->image
        ]);
        $payment->update(['status' => 'pending_review']);
        return redirect()->route('payments.index')->with("success", __('Transfer details sent successfully'));
    }
}
