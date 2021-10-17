<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    
     public function index(Request $request){
        return view('users/user-profile');
     }
    
     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'profile-image'=>'required|image|mimes:jpeg,png,jpg,gif',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $file = $request->file('profile-image')->store('profile','public');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'file_path'=>$file,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('index');

        // return redirect(RouteServiceProvider::HOME);
    }

    public function edit(){
        $user = Auth::user();
        $this->middleware('auth');
        return view('users.edit', [
            'user' => $user,
        ]);
    }
  
    public function update(Request $request){
        $user = Auth::user();
        $this->middleware('auth');

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable','confirmed', Rules\Password::defaults()],
            'profile-image'=>'image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.edit')->withInput()->withErrors($validator);
        }

        if ($request->file('profile-image') == null){
            $file = $user->file_path;
        }
        else{
            $file = $request->file('profile-image')->store('profile','public');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'file_path'=>$file,
        ]);

        flash('Profile Update Successfully')->success();

        return redirect()->route('user.edit');
    }
}
