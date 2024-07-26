<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Province;
use App\Models\User;
use App\Models\UserVerify;
use App\Mail\WelcomeMail;
use App\Mail\ResetMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('profile', 'edit_profile', 'update_profile', 'do_logout');
    }
    public function index()
    {
        return view('page.user.auth.main');
    }
    public function do_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            } else {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $check = User::where("email", "=", $request->email)->first();
        if ($check) {
            if ($check->email_verified_at) {
                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'Customer'], $request->remember)) {
                    if(Auth::guard('web')->user()->province_id){
                        return response()->json([
                            'alert' => 'success',
                            'message' => 'Welcome back ' . Auth::guard('web')->user()->name, 
                        ]);
                    }else{
                        return response()->json([
                            'alert' => 'success',
                            'message' => 'Welcome back ' . Auth::guard('web')->user()->name . '. Harap lengkapi profile anda', 
                        ]);
                    }
                } else {
                    return response()->json([
                        'alert' => 'error',
                        'message' => 'Maaf, sepertinya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.',
                    ]);
                }
            } else {
                return response()->json([
                    'alert' => 'error',
                    'message' => 'Harap Verifikasi di gmail terlebih dahulu.',
                ]);
            }
        }else{
            return response()->json([
                'alert' => 'error',
                'message' => 'Email salah.',
            ]);
        }
    }
    public function do_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'phone' => 'required|unique:users|min:9|max:15',
            'password' => 'required|min:8|max:12',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            } elseif ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            } elseif ($errors->has('phone')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('phone'),
                ]);
            } elseif ($errors->has('password')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $user = new User;
        $user->name = Str::title($request->name);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = Str::before($request->email, '@');
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->role = 'Customer';
        $user->save();

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);
        Mail::to($request->email)->send(new WelcomeMail($user, $token));
        return response()->json([
            'alert' => 'success',
            'message' => 'Customer ' . $request->name . ' Registered',
        ]);
    }
    public function verify($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->email_verified_at) {
                $verifyUser->user->email_verified_at = date("Y-m-d H:i:s");
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('user.auth.index')->with('message', $message);
    }
    public function do_forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            }
        }

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::to($request->email)->send(new ResetMail($token));
        return response()->json([
            'alert' => 'success',
            'message' => 'We have e-mailed your password reset link!',
        ]);
    }
    public function reset($token)
    {
        return view('page.user.auth.reset', compact('token'));
    }
    public function do_reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|exists:password_resets',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('token')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('token'),
                ]);
            } elseif ($errors->has('password')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            } elseif ($errors->has('password_confirmation')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password_confirmation'),
                ]);
            }
        }

        $updatePassword = DB::table('password_resets')
            ->where([
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Invalid token!',
            ]);
        }
        $user = User::where('email', $updatePassword->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $updatePassword->email])->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Your password has been changed!',
            'callback' => 'auth',
        ]);
    }
    public function profile(Request $request)
    {
        if ($request->ajax()) {
            $token = Auth::user()->id;
            $keywords = $request->keywords;
            $collection = Order::where('user_id', $token)
                ->orderBy('id', 'DESC')
                ->paginate(10);
            return view('page.user.auth.list', compact('collection'));
        }
        return view('page.user.auth.profile');
    }
    public function edit_profile(User $user)
    {
        $provinsi= Province::get();
        return view('page.user.auth.edit', compact('user','provinsi'));
    }
    public function update_profile(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|max:255',
            'phone' => 'required|min:9|max:15',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'subdistrict' => 'required',
            'photo' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('name')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('name'),
                ]);
            } elseif ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            } elseif ($errors->has('phone')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('phone'),
                ]);
            } elseif ($errors->has('address')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('address'),
                ]);
            }
             elseif ($errors->has('province')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('province'),
                ]);
            } elseif ($errors->has('city')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('city'),
                ]);
            } elseif ($errors->has('subdistrict')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('subdistrict'),
                ]);
            }
        }
        if (request()->file('photo')) {
            Storage::delete($user->photo);
            $file = request()->file('photo')->store("user");
            $user->photo = $file;
        }
        $user->name = Str::title($request->name);
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->province_id = $request->province;
        $user->city_id = $request->city;
        $user->subdistrict_id = $request->subdistrict;
        $user->postcode = $request->postcode;
        $user->username = Str::before($request->email, '@');
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Profile Updated',
        ]);
    }
    public function do_logout()
    {
        $user = Auth::guard('web')->user();
        Auth::logout($user);
        return redirect()->route('user.home');
    }
}
