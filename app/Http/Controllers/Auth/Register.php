<?php

namespace App\Http\Controllers\Auth;

use App\Models\Auth\User;
use App\Models\Common\Company;
use Illuminate\Support\Str;
use App\Abstracts\Http\Controller;
use App\Jobs\Auth\DeleteInvitation;
use App\Models\Auth\UserInvitation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\Register as Request;
use App\Utilities\Installer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return view('auth.register.create');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\Auth\Register  $request
     * @return \Illuminate\Http\RedirectResponse
     */

     public function store(Request $request)
    {
        $request->validate([
            'company_name'  => 'required|string|max:255',
            'company_email' => 'required|email|max:255|unique:companies,email',
            'email'         => 'required|email|max:255|unique:users,email',
            'user_password' => 'required|string|min:6',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Create the company
                $company = Company::create([
                    'name'  => $request->input('company_name'),
                    'email' => $request->input('company_email'),
                ]);

                // Create the admin user
                $user = User::create([
                    'name'       => 'Admin',
                    'email'      => $request->input('email'),
                    'password'   => Hash::make($request->input('user_password')),
                    'company_id' => $company->id, // Assuming `users` has a `company_id` foreign key
                ]);

                // Fire the Registered event
                event(new Registered($user));
            });

            return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());

            return redirect()->back()->withErrors([
                'error' => 'An error occurred during registration. Please try again later.',
            ]);
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
