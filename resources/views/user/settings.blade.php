<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}'s Settings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any)
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    @endif

                    @if (session('message'))
                        <p>{{ session('message') }}</p>
                    @endif
                    
                    <h1>Your Settings</h1>
                    <form method="POST" action="{{ route('user.update', compact('user')) }}">
                        @csrf

                        <label for="name">Name</label><br>
                        <input type="text" name="name" value="{{ $user->name }}"><br>

                        <label for="gender">Gender</label><br>
                        <select name="gender">
                            @foreach (array_column(App\Enums\Gender::cases(), 'value') as $genderValue)
                            <option value="{{ $genderValue }}" @if ($user->gender == $genderValue) selected @endif>
                                {{ ucfirst($genderValue) }}
                            </option>
                            @endforeach
                        </select><br>
                        
                        <label for="age_category">Age Category</label><br>
                        <select name="age_category">
                            @foreach (array_column(App\Enums\AgeCategory::cases(), 'value') as $ageCategoryValue)
                                <option value="{{ $ageCategoryValue }}" @if (strcmp($user->age_category, $ageCategoryValue) == 0) selected @endif>
                                    {{ $ageCategoryValue }}
                                </option>
                            @endforeach
                        </select><br>

                        <h1>Your Intake Profile</h1>

                        <table>
                            <tr>
                                <th></th>
                                <th>Your daily maximum</th>
                                <th>
                                    <p>Medium boundary</p>
                                    <i class="text-sm">(g per 100g)</i>
                                </th>
                                <th>
                                    <p>High boundary</p>
                                    <i class="text-sm">(g per 100g)</i>
                                </th>
                            </tr>
                            <tr>
                                <td>Calories</td>
                                <td>
                                    <p>{{ $ageCategory->minCategoryIntake($gender, 'max_calories') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_calories') }}</p>
                                    <input type="number" name="max_calories" value="{{ $user->intakeProfile->max_calories }}">
                                </td>
                            </tr>
                            <tr>
                                <td>Total fat</td>
                                <td>
                                    <p>{{ $ageCategory->minCategoryIntake($gender, 'max_total_fat') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_fat') }}</p>
                                    <input type="number" step=".1" name="max_total_fat" value="{{ $user->intakeProfile->max_total_fat }}">
                                </td>
                                <td>
                                    <input type="number" step=".1" name="med_total_fat_boundary" value="{{ $user->intakeProfile->med_total_fat_boundary }}"/>
                                </td>
                                <td>
                                    <input type="number" step=".1" name="high_total_fat_boundary" value="{{ $user->intakeProfile->high_total_fat_boundary }}"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Saturated Fat</td>
                                <td>
                                    <p>{{ $ageCategory->minCategoryIntake($gender, 'max_saturated_fat') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_saturated_fat') }}</p>
                                    <input type="number" step=".1" name="max_saturated_fat" value="{{ $user->intakeProfile->max_saturated_fat }}">
                                </td>
                                <td>
                                    <input type="number" step=".1" name="med_saturated_fat_boundary" value="{{ $user->intakeProfile->med_saturated_fat_boundary }}"/>
                                </td>
                                <td>
                                    <input type="number" step=".1" name="high_saturated_fat_boundary" value="{{ $user->intakeProfile->high_saturated_fat_boundary }}"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Sugar</td>
                                <td>
                                    <p>{{ $ageCategory->minCategoryIntake($gender, 'max_total_sugar') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_sugar') }}</p>
                                    <input type="number" step=".1" name="max_total_sugar" value="{{ $user->intakeProfile->max_total_sugar }}">
                                </td>
                                <td>
                                    <input type="number" step=".1" name="med_total_sugar_boundary" value="{{ $user->intakeProfile->med_total_sugar_boundary }}"/>
                                </td>
                                <td>
                                    <input type="number" step=".1" name="high_total_sugar_boundary" value="{{ $user->intakeProfile->high_total_sugar_boundary }}"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Salt</td>
                                <td>
                                    <p>{{ $ageCategory->minCategoryIntake($gender, 'max_salt') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_salt') }}</p>
                                    <input type="number" step=".1" name="max_salt" value="{{ $user->intakeProfile->max_salt }}">
                                </td>
                                <td>
                                    <input type="number" step=".1" name="med_salt_boundary" value="{{ $user->intakeProfile->med_salt_boundary }}"/>
                                </td>
                                <td>
                                    <input type="number" step=".1" name="high_salt_boundary" value="{{ $user->intakeProfile->high_salt_boundary }}"/>
                                </td>
                            </tr>
                        </table>

                        <input type="submit" value="Save Settings">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
