<?php

namespace App\Http\Controllers;

use App\Models\EmiRule;
use App\Services\EmiRuleService;
use App\Services\TenureService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $tenureService;
    protected $emiRuleService;
    public function __construct(TenureService $tenureService, EmiRuleService $emiRuleService)
    {
        $this->tenureService = $tenureService;
        $this->emiRuleService = $emiRuleService;
    }


    public function showLoginForm()
    {
        if (auth()->check() && auth()->user()->user_type === 'user') {
            return redirect()->route('user.dashboard');
        }
        return view('user.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->user_type === 'user') {
                return redirect()->route('user.dashboard');
            }

            Auth::logout();
            return redirect()->route('user.login')->with('error', 'Unauthorized access.');
        }

        // If authentication fails, redirect back with an error message

        return redirect()->back()->withErrors('Invalid credentials');
    }

    public function showRegistrationForm()
    {
        return view('user.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required'
        ]);

        $userService = new UserService();
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'user', // Set user type to 'user'
        ];

        $user =  $userService->store($userData);
        Auth::login($user, true); // Log in the user after registration

        return redirect()->route('user.dashboard')->with('message', 'Registration successful. Welcome!');
    }

    public function dashboard()
    {

        return view('user.dashboard')->with([
            'tenures' => $this->tenureService->getAllTenures(),
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.form')->with('message', 'You have been logged out successfully.');
    }

    public function profile()
    {
        return view('user.profile')->with([
            'user' => Auth::user(),
        ]);
    }

    public function calculate(Request $request)
     {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'tenure_id' => 'required|exists:tenures,id'
        ]);

        $amount = $request->amount;
        $tenure_id = $request->tenure_id;

        $emiRule = $this->emiRuleService->checkAndGetEmiRule($amount, $amount, $tenure_id);

        if (!$emiRule) {
            return redirect()->route('user.dashboard')->with('emi_error', 'No EMI Rule found for this selection.');
        }


        $ratePerMonth = ($emiRule->interest_rate / 100) / 12;
        $months = $emiRule->tenure->months;

        $emi = ($amount * $ratePerMonth * pow(1 + $ratePerMonth, $months)) / (pow(1 + $ratePerMonth, $months) - 1);
        $totalAmount = $emi * $months;

        return back()->with([
            'emi' => number_format($emi, 2),
            'total' => number_format($totalAmount, 2),
        ]);

    }

    
}
