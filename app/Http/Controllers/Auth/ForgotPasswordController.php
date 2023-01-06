<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB; 
use Mail; 
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Show forgot password form
     * 
     */
    public function showForgetPasswordForm()
    {
        return view('auth.guest.forgetPassword');
    }

    /**
     * Forgot Password mail smtp
     * 
     */
    public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
          ], [
              'exists' => 'Email tidak ditemukan.'
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token,
              'created_at' => now()
            ]);
  
          Mail::send('auth.guest.mailPasswordReset', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'Reset Password Terkirim. Cek Email Anda!');
      }

      /**
       * Show reset password form
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
        return view('auth.guest.resetPassword', ['token' => $token]);
     }
 
     /**
      * Reset Password 
      *
      * @return response()
      */
     public function submitResetPasswordForm(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:users',
             'password' => 'required|string|min:6|confirmed',
             'password_confirmation' => 'required'
         ],[
             'exists' => 'Email tidak tersedia.',
             'confirmed' => 'Konfirmasi password salah.',
             'min' => 'Password minimal memiliki 6 karakter.',
             'required' => 'Field :attribute harus diisi.'
         ]);
 
         $updatePassword = DB::table('password_resets')
                             ->where([
                               'email' => $request->email, 
                               'token' => $request->token
                             ])
                             ->first();
 
         if(!$updatePassword){
             return back()->withInput()->with('error', 'Invalid token!');
         }
 
         $user = User::where('email', $request->email)
                     ->update(['password' => Hash::make($request->password)]);

         DB::table('password_resets')->where(['email'=> $request->email])->delete();
 
         return redirect()->intended('login')->with('reset_password', 'Password anda telah terganti!');
     }
}
