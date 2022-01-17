<?php

namespace App\Http\Controllers\Auth;

use App\Enums\AgeCategory;
use App\Enums\AgeCategory as EnumsAgeCategory;
use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Models\IntakeProfile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => Gender::UNSPECIFIED->value,
            'age_category' => AgeCategory::DEFAULT->value,
        ]);

        $gender = Gender::genderFromString($user->gender);
        $ageCategory = AgeCategory::ageCategoryFromString($user->age_category);
        $intakeProfile = $ageCategory->defaultIntakeProfile($gender);
        $user->intakeProfile()->create($intakeProfile);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
