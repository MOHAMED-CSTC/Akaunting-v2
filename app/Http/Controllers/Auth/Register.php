<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\User;
use Illuminate\Support\Str;
use App\Abstracts\Http\Controller;
use App\Jobs\Auth\DeleteInvitation;
use App\Models\Auth\UserInvitation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\Register as Request;

class Register extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');  // Ensure only guests can access registration
    }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    // public function create($token)
    public function create()
    {
        $required = ['name' => true, 'email' => true, 'password' => true];
        // $invitation = UserInvitation::token(token: $token)->first();

        // if ($invitation) {
        //     return view('auth.register.create', ['token' => $token]);
        // }
    
        // abort(403);
        return view('auth.register.create',compact('required'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\Auth\Register  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:6', // Ensure the password is confirmed
            ]);
    
            // Prepare user data
            $userData = array_merge($validated, [
                'password' => Hash::make($validated['password']),
                'locale' => app()->getLocale(),
                'enabled' => true,
                'landing_page' => '/dashboard',
                'created_from' => $request->ip(),
                'created_by' => null,
            ]);
    
            // Debugging logs
            \Log::info('Creating user with data:', $userData);
    
            // Create the user
            $user = User::create($userData);
    
            // Trigger the Registered event
            event(new Registered($user));
    
            // Redirect with a success message
            return redirect()->route('login')->with('success', 'Registration successful');
        } catch (\Throwable $e) {
            // Log the error for debugging
            \Log::error('Error creating user: ' . $e->getMessage());
    
            // Redirect back with a friendly error message
            return redirect()->back()->withErrors(['error' => 'User creation failed. Please try again later.']);
        }
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Define validation rules for registration
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
