<?php

namespace App\Http\Controllers;

use App\Enums\AgeCategory;
use App\Enums\Gender;
use App\Models\ScanHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Show the user's dashboard showing their product scan history.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showDashboard() {
        $scanHistoryEntries = Auth::user()->scanHistoryEntries()->orderBy('created_at', 'desc')->get();

        // Split created time and date into atomic values
        foreach ($scanHistoryEntries as $entry => $data) {
            $dateTime = preg_split("/[-\s:]/", $data->created_at);
            $data['year'] = $dateTime[0];
            $data['month'] = $dateTime[1];
            $data['day'] = $dateTime[2];
            $data['hour'] = $dateTime[3];
            $data['minute'] = $dateTime[4];
            $data['second'] = $dateTime[5];
        }

        return view('dashboard', compact('scanHistoryEntries'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the currently logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $ageCategory = AgeCategory::ageCategoryFromString($user->age_category);
        $gender = Gender::genderFromString($user->gender);
        return view('user.settings', compact('user', 'ageCategory', 'gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user() != $user) {
            return abort(401);
        }

        // Validate the user settings
        $request->validate([
            'name' => ['required', 'max:255'],
            'gender' => ['required', Rule::in(array_column(Gender::cases(), 'value'))],
            'age_category' => ['required', Rule::in(array_column(AgeCategory::cases(), 'value'))],
        ]);

        // Validate the intake profile values
        $gender = Gender::genderFromString($request->gender);
        $ageCategory = AgeCategory::ageCategoryFromString($request->age_category);
        $maxIntakeProfile = $ageCategory->maxIntakeProfile($gender);
        $minIntakeProfile = $ageCategory->minIntakeProfile($gender);
        $request->validate([
            'max_calories' => [
                'required',
                'lte:' . $maxIntakeProfile['max_calories'],
                'gte:' . $minIntakeProfile['max_calories']
            ],

            'med_total_fat_boundary' => [
                'required',
                'gt:0',
                'lte:high_total_fat_boundary'
            ],
            'high_total_fat_boundary' => [
                'required',
                'gte:med_total_fat_boundary',
                'lte:max_total_fat'
            ],
            'max_total_fat' => [
                'required',
                'lte:' . $maxIntakeProfile['max_total_fat'],
                'gte:' . $minIntakeProfile['max_total_fat']
            ],
            
            'med_saturated_fat_boundary' => [
                'required',
                'gt:0',
                'lte:high_saturated_fat_boundary'
            ],
            'high_saturated_fat_boundary' => [
                'required',
                'gte:med_saturated_fat_boundary',
                'lte:max_saturated_fat'
            ],
            'max_saturated_fat' => [
                'required',
                'lte:' . $maxIntakeProfile['max_saturated_fat'],
                'gte:' . $minIntakeProfile['max_saturated_fat']
            ],
            
            'med_total_sugar_boundary' => [
                'required',
                'gt:0',
                'lte:high_total_sugar_boundary'
            ],
            'high_total_sugar_boundary' => [
                'required',
                'gte:med_total_sugar_boundary',
                'lte:max_total_sugar'
            ],
            'max_total_sugar' => [
                'required',
                'lte:' . $maxIntakeProfile['max_total_sugar'],
                'gte:' . $minIntakeProfile['max_total_sugar']
            ],
            
            'med_salt_boundary' => [
                'required',
                'gt:0',
                'lte:high_salt_boundary'
            ],
            'high_salt_boundary' => [
                'required',
                'gte:med_salt_boundary',
                'lte:max_salt'
            ],
            'max_salt' => [
                'required',
                'lte:' . $maxIntakeProfile['max_salt'],
                'gte:' . $minIntakeProfile['max_salt']
            ],
        ]);

        $user->update($request->only(['name', 'gender', 'age_category']));
        $user->intakeProfile()->update($request->only(['max_calories', 'max_total_fat',
                'med_total_fat_boundary', 'high_total_fat_boundary', 'max_saturated_fat',
                'med_saturated_fat_boundary', 'high_saturated_fat_boundary', 'max_total_sugar',
                'med_total_sugar_boundary', 'high_total_sugar_boundary', 'max_salt',
                'med_salt_boundary', 'high_salt_boundary']));

        return redirect()->route('user.settings')
            ->with('message', 'Your settings have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
