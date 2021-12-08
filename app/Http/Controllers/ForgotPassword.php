<?php

namespace App\Http\Controllers;

use App\Mail\RestPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use Ramsey\Uuid\Uuid;

class ForgotPassword extends Controller
{
    public function viewReset()
    {
        return view('forgot_password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
        ]);

        $user = User::whereEmail($request->email)->first();
        if ($user) {
            $uuid = Uuid::uuid4();
            $user->update([
                'remember_token' => $uuid,
            ]);

            Mail::to($request->email)->send(new RestPasswordMail($uuid));
            sendFlash('Please Check Your Email');
            return back()->with('message', 'Please Check Your Email');

        } else {
            sendFlash("We Can't Found Your!!", 'error');
            return back()->with('message', "We Can't Found Your!!");
        }
    }

    public function setNewPassword($uu_id)
    {
        $user = User::whereRememberToken($uu_id)->first();
        if ($user) {
            $uu_id = $uu_id;
            return view('set_new_password', compact('uu_id'));
        } else {
            return redirect()->route('reset.password');
        }
    }

    public function createNewPassword(Request $request, $uuid)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::whereRememberToken($uuid)->first();
        if ($user) {
            $user->update([
                'password'       => Hash::make($request->password),
                'remember_token' => Uuid::uuid4(),
            ]);
            return redirect('/')->with('message', 'Password Update Successfully');
        } else {
            return redirect('/')->with('message', 'Something is Problem');
        }
    }

}
