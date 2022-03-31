<x-app-layout>
    <x-slot name="title">
        {{ $user->name }}'s Settings
    </x-slot>

    <div class="flex flex-col items-center pb-32">
        <x-auth-validation-errors :errors="$errors" />

        <x-auth-session-status :status="session('message')" />

        <form method="POST" action="{{ route('user.update', compact('user')) }}" id="settings-form" class="flex flex-col items-center mt-2 w-full max-w-2xl">
            @csrf
            
            <div class="flex flex-col items-center w-full max-w-sm">
                <h1 class="text-lg font-bold">Your Details</h1>

                <div class="w-full">
                    <x-label for="name">Name</x-label>
                    <x-input type="text" name="name" value="{{ $user->name }}"/>
                </div>

                <div class="w-full flex flex-col xs:flex-row gap-x-2">
                    <div class="w-full mt-2">
                        <x-label for="gender">Gender</x-label>
                        <select name="gender" class="w-full box-border border-2 border-nutrient-med focus:border-nutrient-med focus:ring focus:ring-nutrient-med focus:ring-opacity-50">
                            @foreach (array_column(App\Enums\Gender::cases(), 'value') as $genderValue)
                            <option value="{{ $genderValue }}" @if ($user->gender == $genderValue) selected @endif class="">
                                {{ ucfirst($genderValue) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="w-full mt-2">
                        <x-label for="age_category">Age Category</x-label>
                        <select name="age_category" class="w-full box-border border-2 border-nutrient-med focus:border-nutrient-med focus:ring focus:ring-nutrient-med focus:ring-opacity-50">
                            @foreach (array_column(App\Enums\AgeCategory::cases(), 'value') as $ageCategoryValue)
                                <option value="{{ $ageCategoryValue }}" @if (strcmp($user->age_category, $ageCategoryValue) == 0) selected @endif class="focus:bg-gray-200">
                                    {{ $ageCategoryValue }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-full max-w-lg mt-8 gap-y-4">
                <h1 class="text-lg text-center font-bold">Your Intake Profile</h1>

                <div class="w-full p-2 border-2 border-gray-300">
                    <h2 class="font-bold">Calories</h2>
                    <div class="flex justify-center">
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_calories') }}kcal to {{ $ageCategory->maxCategoryIntake($gender, 'max_calories') }}kcal</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" name="max_calories" value="{{ $user->intakeProfile->max_calories }}"/>
                                <p>kcal</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full p-2 border-2 border-gray-300">
                    <h2 class="font-bold">Total fat</h2>
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mt-0.5">
                        <div>
                            <h3>Amber boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" name="med_total_fat_boundary" value="{{ $user->intakeProfile->med_total_fat_boundary }}"/>
                                <p class="text-sm">g per 100g</p>
                            </div>
                        </div>
                        <div>
                            <h3>Red boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" name="high_total_fat_boundary" value="{{ $user->intakeProfile->high_total_fat_boundary }}"/>
                                    <p class="text-sm">g per 100g</p>
                                </div>
                            </div>
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_total_fat') }}g to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_fat') }}g</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" step=".1" name="max_total_fat" value="{{ $user->intakeProfile->max_total_fat }}"/>
                                <p>g</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row h-8 w-full mt-2">
                        <div class="flex flex-row-reverse items-center bg-nutrient-low px-0.5" style="width: {{ 100 * $user->intakeProfile->med_total_fat_boundary / $user->intakeProfile->max_total_fat }}%">
                            <p class="text-right hidden xs:block overflow-hidden">{{ $user->intakeProfile->med_total_fat_boundary }}g</p>
                        </div>
                        <div class="flex flex-row-reverse items-center bg-nutrient-med px-0.5" style="width: {{ 100 * ($user->intakeProfile->high_total_fat_boundary - $user->intakeProfile->med_total_fat_boundary) / $user->intakeProfile->max_total_fat }}%">
                            <p class="text-right hidden xs:block overflow-hidden">{{ $user->intakeProfile->high_total_fat_boundary }}g</p>
                        </div>
                        <div class="flex flex-row-reverse items-center bg-nutrient-high px-0.5" style="width: {{ 100 * ($user->intakeProfile->max_total_fat - $user->intakeProfile->high_total_fat_boundary) / $user->intakeProfile->max_total_fat }}%">
                            <p class="text-right hidden xs:block overflow-hidden text-white">{{ $user->intakeProfile->max_total_fat }}g</p>
                        </div>
                    </div>
                </div>

                <div class="w-full p-2 border-2 border-gray-300">
                    <h2 class="font-bold">Saturated fat</h2>
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mt-0.5">
                        <div>
                            <h3>Amber boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" name="med_saturated_fat_boundary" value="{{ $user->intakeProfile->med_saturated_fat_boundary }}"/>
                                <p class="text-sm">g per 100g</p>
                            </div>
                        </div>
                        <div>
                            <h3>Red boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" name="high_saturated_fat_boundary" value="{{ $user->intakeProfile->high_saturated_fat_boundary }}"/>
                                    <p class="text-sm">g per 100g</p>
                                </div>
                            </div>
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_saturated_fat') }}g to {{ $ageCategory->maxCategoryIntake($gender, 'max_saturated_fat') }}g</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" step=".1" name="max_saturated_fat" value="{{ $user->intakeProfile->max_saturated_fat }}"/>
                                <p>g</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row h-8 w-full mt-2">
                        <div class="flex flex-row-reverse items-center bg-nutrient-low px-0.5" style="width: {{ 100 * $user->intakeProfile->med_saturated_fat_boundary / $user->intakeProfile->max_saturated_fat }}%">
                            <p class="text-right hidden xs:block overflow-hidden">{{ $user->intakeProfile->med_saturated_fat_boundary }}g</p>
                        </div>
                        <div class="flex flex-row-reverse items-center bg-nutrient-med px-0.5" style="width: {{ 100 * ($user->intakeProfile->high_saturated_fat_boundary - $user->intakeProfile->med_saturated_fat_boundary) / $user->intakeProfile->max_saturated_fat }}%">
                            <p class="text-right hidden xs:block overflow-hidden">{{ $user->intakeProfile->high_saturated_fat_boundary }}g</p>
                        </div>
                        <div class="flex flex-row-reverse items-center bg-nutrient-high px-0.5" style="width: {{ 100 * ($user->intakeProfile->max_saturated_fat - $user->intakeProfile->high_saturated_fat_boundary) / $user->intakeProfile->max_saturated_fat }}%">
                            <p class="text-right hidden xs:block overflow-hidden text-white">{{ $user->intakeProfile->max_saturated_fat }}g</p>
                        </div>
                    </div>
                </div>

                <div class="w-full p-2 border-2 border-gray-300">
                    <h2 class="font-bold">Total Sugar</h2>
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mt-0.5">
                        <div>
                            <h3>Amber boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" name="med_total_sugar_boundary" value="{{ $user->intakeProfile->med_total_sugar_boundary }}"/>
                                <p class="text-sm">g per 100g</p>
                            </div>
                        </div>
                        <div>
                            <h3>Red boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" name="high_total_sugar_boundary" value="{{ $user->intakeProfile->high_total_sugar_boundary }}"/>
                                    <p class="text-sm">g per 100g</p>
                                </div>
                            </div>
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_total_sugar') }}g to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_sugar') }}g</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" step=".1" name="max_total_sugar" value="{{ $user->intakeProfile->max_total_sugar }}"/>
                                <p>g</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row h-8 w-full mt-2">
                        <div class="flex flex-row-reverse items-center bg-nutrient-low px-0.5" style="width: {{ 100 * $user->intakeProfile->med_total_sugar_boundary / $user->intakeProfile->max_total_sugar }}%">
                            <p class="text-right hidden xs:block overflow-hidden">{{ $user->intakeProfile->med_total_sugar_boundary }}g</p>
                        </div>
                        <div class="flex flex-row-reverse items-center bg-nutrient-med px-0.5" style="width: {{ 100 * ($user->intakeProfile->high_total_sugar_boundary - $user->intakeProfile->med_total_sugar_boundary) / $user->intakeProfile->max_total_sugar }}%">
                            <p class="text-right hidden xs:block overflow-hidden">{{ $user->intakeProfile->high_total_sugar_boundary }}g</p>
                        </div>
                        <div class="flex flex-row-reverse items-center bg-nutrient-high px-0.5" style="width: {{ 100 * ($user->intakeProfile->max_total_sugar - $user->intakeProfile->high_total_sugar_boundary) / $user->intakeProfile->max_total_sugar }}%">
                            <p class="text-right hidden xs:block overflow-hidden text-white">{{ $user->intakeProfile->max_total_sugar }}g</p>
                        </div>
                    </div>
                </div>

                <div class="w-full p-2 border-2 border-gray-300">
                    <h2 class="font-bold">Salt</h2>
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mt-0.5">
                        <div>
                            <h3>Amber boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" name="med_salt_boundary" value="{{ $user->intakeProfile->med_salt_boundary }}"/>
                                <p class="text-sm">g per 100g</p>
                            </div>
                        </div>
                        <div>
                            <h3>Red boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" name="high_salt_boundary" value="{{ $user->intakeProfile->high_salt_boundary }}"/>
                                    <p class="text-sm">g per 100g</p>
                                </div>
                            </div>
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_salt') }}g to {{ $ageCategory->maxCategoryIntake($gender, 'max_salt') }}g</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" step=".1" name="max_salt" value="{{ $user->intakeProfile->max_salt }}"/>
                                <p>g</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row h-8 w-full mt-2">
                        <div class="flex flex-row-reverse items-center bg-nutrient-low px-0.5" style="width: {{ 100 * $user->intakeProfile->med_salt_boundary / $user->intakeProfile->max_salt }}%">
                            <p class="text-right hidden xs:block overflow-hidden">{{ $user->intakeProfile->med_salt_boundary }}g</p>
                        </div>
                        <div class="flex flex-row-reverse items-center bg-nutrient-med px-0.5" style="width: {{ 100 * ($user->intakeProfile->high_salt_boundary - $user->intakeProfile->med_salt_boundary) / $user->intakeProfile->max_salt }}%">
                            <p class="text-right hidden xs:block overflow-hidden">{{ $user->intakeProfile->high_salt_boundary }}g</p>
                        </div>
                        <div class="flex flex-row-reverse items-center bg-nutrient-high px-0.5" style="width: {{ 100 * ($user->intakeProfile->max_salt - $user->intakeProfile->high_salt_boundary) / $user->intakeProfile->max_salt }}%">
                            <p class="text-right hidden xs:block overflow-hidden text-white">{{ $user->intakeProfile->max_salt }}g</p>
                        </div>
                    </div>
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex flex-col items-center space-y-2 p-2">
                    <div class="w-full flex flex-col sm:flex-row items-center justify-center gap-2">
                        <x-button-secondary href="{{ route('dashboard') }}">Return Without Saving</x-button-secondary>
                        <x-button-submit form="settings-form">Save Settings</x-button-submit>
                    </div>
                </div>
            </x-slot>
        </form>
    </div>
</x-app-layout>
