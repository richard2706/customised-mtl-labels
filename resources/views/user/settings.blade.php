<x-app-layout>
    <x-slot name="title">
        {{ $user->name }}'s Settings
    </x-slot>

    <div class="flex flex-col items-center pb-16">
        <x-auth-validation-errors :errors="$errors" />

        <x-auth-session-status :status="session('message')" />

        <form method="POST" action="{{ route('user.update', compact('user')) }}" id="settings-form" class="mt-2">
            @csrf
            
            <div class="mb-4">
                <h1 class="text-lg">Your Details</h1>

                <div class="my-2">
                    <x-label for="name">Name</x-label>
                    <x-input type="text" name="name" value="{{ $user->name }}"/><br>
                </div>

                <div class="my-2">
                    <x-label for="gender">Gender</x-label>
                    <select name="gender">
                        @foreach (array_column(App\Enums\Gender::cases(), 'value') as $genderValue)
                        <option value="{{ $genderValue }}" @if ($user->gender == $genderValue) selected @endif>
                            {{ ucfirst($genderValue) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="my-2">
                    <x-label for="age_category">Age Category</x-label>
                    <select name="age_category">
                        @foreach (array_column(App\Enums\AgeCategory::cases(), 'value') as $ageCategoryValue)
                            <option value="{{ $ageCategoryValue }}" @if (strcmp($user->age_category, $ageCategoryValue) == 0) selected @endif>
                                {{ $ageCategoryValue }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <h1 class="text-lg">Your Intake Profile</h1>
                <ul class="list-disc ml-4 mb-4">
                    <li>Nutrients with less than the medium boundary per 100g will appear <span class="text-nutrient-low font-bold">green</span></li>
                    <li>Nutrients with more than (or the same as) the medium boundary per 100g will appear <span class="text-nutrient-med font-bold">amber</span></li>
                    <li>Nutrients with more than (or the same as) the high boundary per 100g will appear <span class="text-nutrient-high font-bold">red</span></li>
                </ul>
                <table class="border-separate">
                    <tr>
                        <th class="p-1"></th>
                        <th class="p-1">Your daily maximum</th>
                        <th class="p-1 bg-nutrient-med">
                            <p>Medium boundary</p>
                            <i class="text-sm">(g per 100g)</i>
                        </th>
                        <th class="p-1 bg-nutrient-high text-white">
                            <p>High boundary</p>
                            <i class="text-sm">(g per 100g)</i>
                        </th>
                    </tr>
                    <tr>
                        <td class="p-1">Calories</td>
                        <td class="p-1">
                            <i class="text-sm">{{ $ageCategory->minCategoryIntake($gender, 'max_calories') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_calories') }}</i>
                            <br>
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" name="max_calories" value="{{ $user->intakeProfile->max_calories }}"/>
                                <p>kcal</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">Total fat</td>
                        <td class="p-1">
                            <i class="text-sm">{{ $ageCategory->minCategoryIntake($gender, 'max_total_fat') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_fat') }}</i>
                            <br>
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="max_total_fat" value="{{ $user->intakeProfile->max_total_fat }}"/>
                                <p>g</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="med_total_fat_boundary" value="{{ $user->intakeProfile->med_total_fat_boundary }}"/>
                                <p>g</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="high_total_fat_boundary" value="{{ $user->intakeProfile->high_total_fat_boundary }}"/>
                                <p>g</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">Saturated Fat</td>
                        <td class="p-1">
                            <i class="text-sm">{{ $ageCategory->minCategoryIntake($gender, 'max_saturated_fat') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_saturated_fat') }}</i>
                            <br>
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="max_saturated_fat" value="{{ $user->intakeProfile->max_saturated_fat }}"/>
                                <p>g</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="med_saturated_fat_boundary" value="{{ $user->intakeProfile->med_saturated_fat_boundary }}"/>
                                <p>g</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="high_saturated_fat_boundary" value="{{ $user->intakeProfile->high_saturated_fat_boundary }}"/>
                                <p>g</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">Total Sugar</td>
                        <td class="p-1">
                            <i class="text-sm">{{ $ageCategory->minCategoryIntake($gender, 'max_total_sugar') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_sugar') }}</i>
                            <br>
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="max_total_sugar" value="{{ $user->intakeProfile->max_total_sugar }}"/>
                                <p>g</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="med_total_sugar_boundary" value="{{ $user->intakeProfile->med_total_sugar_boundary }}"/>
                                <p>g</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="high_total_sugar_boundary" value="{{ $user->intakeProfile->high_total_sugar_boundary }}"/>
                                <p>g</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-1">Salt</td>
                        <td class="p-1">
                            <i class="text-sm">{{ $ageCategory->minCategoryIntake($gender, 'max_salt') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_salt') }}</i><br>
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="max_salt" value="{{ $user->intakeProfile->max_salt }}"/>
                                <p>g</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="med_salt_boundary" value="{{ $user->intakeProfile->med_salt_boundary }}"/>
                                <p>g</p>
                            </div>
                        </td>
                        <td class="p-1">
                            <div class="flex items-center space-x-2">
                                <x-input class="w-24" type="number" step=".1" name="high_salt_boundary" value="{{ $user->intakeProfile->high_salt_boundary }}"/>
                                <p>g</p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            <x-slot name="footer">
                <div class="flex flex-col items-center space-y-2 p-2">
                    <x-button-submit form="settings-form">Save Settings</x-button-submit>
                </div>
            </x-slot>
        </form>
    </div>
</x-app-layout>
