<x-app-layout>
    <x-slot name="title">
        {{ $user->name }}'s Settings
    </x-slot>

    <div class="flex flex-col items-center short:pb-32">
        <x-auth-validation-errors :errors="$errors" />

        <x-auth-session-status :status="session('message')" />

        <form method="POST" action="{{ route('user.update', compact('user')) }}" id="settings-form" class="flex flex-col items-center mt-2 w-full">
            @csrf
            
            <div class="flex flex-col items-center max-w-sm">
                <h1 class="text-xl font-bold">Your Details</h1>

                <div class="w-full">
                    <x-label for="name">Name</x-label>
                    <x-input type="text" name="name" value="{{ $user->name }}"/>
                </div>

                <div class="w-full flex flex-col xs:flex-row gap-x-3 mt-3">
                    <div class="w-full">
                        <x-label for="gender">Gender</x-label>
                        <select name="gender" class="w-full box-border border-4 border-nutrient-med focus:border-nutrient-med focus:ring focus:ring-nutrient-med focus:ring-opacity-50">
                            @foreach (array_column(App\Enums\Gender::cases(), 'value') as $genderValue)
                            <option value="{{ $genderValue }}" @if ($user->gender == $genderValue) selected @endif class="">
                                {{ ucfirst($genderValue) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="w-full">
                        <x-label for="age_category">Age Category</x-label>
                        <select name="age_category" class="w-full box-border border-4 border-nutrient-med focus:border-nutrient-med focus:ring focus:ring-nutrient-med focus:ring-opacity-50">
                            @foreach (array_column(App\Enums\AgeCategory::cases(), 'value') as $ageCategoryValue)
                                <option value="{{ $ageCategoryValue }}" @if (strcmp($user->age_category, $ageCategoryValue) == 0) selected @endif class="focus:bg-gray-200">
                                    {{ $ageCategoryValue }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center mt-8 gap-y-4 w-full max-w-xl">
                <h1 class="text-xl text-center font-bold">Your Intake Profile</h1>

                <x-button-submit form="reset-user-form">Reset All to the Reference Intake</x-button-submit>

                <div class="w-full p-2 border-2 border-gray-300">
                    <h2 class="text-md font-bold">Calories</h2>
                    <div class="flex justify-center">
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_calories') }}kcal to {{ $ageCategory->maxCategoryIntake($gender, 'max_calories') }}kcal</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" min="{{ $ageCategory->minCategoryIntake($gender, 'max_calories') }}" max="{{ $ageCategory->maxCategoryIntake($gender, 'max_calories') }}" name="max_calories" value="{{ $user->intakeProfile->max_calories }}"/>
                                <p>kcal</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full p-2 border-2 border-gray-300">
                    <h2 class="text-md font-bold">Total fat</h2>
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2">
                        <div>
                            <h3>Amber boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" min="0" name="med_total_fat_boundary" value="{{ $user->intakeProfile->med_total_fat_boundary }}"/>
                                <p class="text-sm">g per 100g</p>
                            </div>
                        </div>
                        <div>
                            <h3>Red boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" min="0" name="high_total_fat_boundary" value="{{ $user->intakeProfile->high_total_fat_boundary }}"/>
                                    <p class="text-sm">g per 100g</p>
                                </div>
                            </div>
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_total_fat') }}g to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_fat') }}g</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" step=".1" min="{{ $ageCategory->minCategoryIntake($gender, 'max_total_fat') }}" max="{{ $ageCategory->maxCategoryIntake($gender, 'max_total_fat') }}" name="max_total_fat" value="{{ $user->intakeProfile->max_total_fat }}"/>
                                <p>g</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row h-8 w-full mt-4">
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
                    <h2 class="text-md font-bold">Saturated fat</h2>
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2">
                        <div>
                            <h3>Amber boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" min="0" name="med_saturated_fat_boundary" value="{{ $user->intakeProfile->med_saturated_fat_boundary }}"/>
                                <p class="text-sm">g per 100g</p>
                            </div>
                        </div>
                        <div>
                            <h3>Red boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" min="0" name="high_saturated_fat_boundary" value="{{ $user->intakeProfile->high_saturated_fat_boundary }}"/>
                                    <p class="text-sm">g per 100g</p>
                                </div>
                            </div>
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_saturated_fat') }}g to {{ $ageCategory->maxCategoryIntake($gender, 'max_saturated_fat') }}g</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" step=".1" min="{{ $ageCategory->minCategoryIntake($gender, 'max_saturated_fat') }}" max="{{ $ageCategory->maxCategoryIntake($gender, 'max_saturated_fat') }}" name="max_saturated_fat" value="{{ $user->intakeProfile->max_saturated_fat }}"/>
                                <p>g</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row h-8 w-full mt-4">
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
                    <h2 class="text-md font-bold">Total Sugar</h2>
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2">
                        <div>
                            <h3>Amber boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" min="0" name="med_total_sugar_boundary" value="{{ $user->intakeProfile->med_total_sugar_boundary }}"/>
                                <p class="text-sm">g per 100g</p>
                            </div>
                        </div>
                        <div>
                            <h3>Red boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" min="0" name="high_total_sugar_boundary" value="{{ $user->intakeProfile->high_total_sugar_boundary }}"/>
                                    <p class="text-sm">g per 100g</p>
                                </div>
                            </div>
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_total_sugar') }}g to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_sugar') }}g</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" step=".1" name="max_total_sugar" min="{{ $ageCategory->minCategoryIntake($gender, 'max_total_sugar') }}" max="{{ $ageCategory->maxCategoryIntake($gender, 'max_total_sugar') }}" value="{{ $user->intakeProfile->max_total_sugar }}"/>
                                <p>g</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row h-8 w-full mt-4">
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
                    <h2 class="text-md font-bold">Salt</h2>
                    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2">
                        <div>
                            <h3>Amber boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" min="0" name="med_salt_boundary" value="{{ $user->intakeProfile->med_salt_boundary }}"/>
                                <p class="text-sm">g per 100g</p>
                            </div>
                        </div>
                        <div>
                            <h3>Red boundary</h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input class="w-24" type="number" step=".1" min="0" name="high_salt_boundary" value="{{ $user->intakeProfile->high_salt_boundary }}"/>
                                    <p class="text-sm">g per 100g</p>
                                </div>
                            </div>
                        <div>
                            <h3>Daily maximum <i class="text-xs text-gray-700">{{ $ageCategory->minCategoryIntake($gender, 'max_salt') }}g to {{ $ageCategory->maxCategoryIntake($gender, 'max_salt') }}g</i></h3>
                            <div class="flex items-center gap-x-2 w-32 mt-1">
                                <x-input type="number" step=".1" name="max_salt" min="{{ $ageCategory->minCategoryIntake($gender, 'max_salt') }}" max="{{ $ageCategory->maxCategoryIntake($gender, 'max_salt') }}" value="{{ $user->intakeProfile->max_salt }}"/>
                                <p>g</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row h-8 w-full mt-4">
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
                <div class="flex flex-col items-center gap-y-2 p-2">
                    <div class="w-full flex flex-col sm:flex-row items-center justify-center gap-2">
                        <x-button-secondary href="{{ route('dashboard') }}">Return Without Saving</x-button-secondary>
                        <x-button-submit form="settings-form">Save Settings</x-button-submit>
                    </div>
                </div>
            </x-slot>
        </form>

        <form method="POST" action="{{ route('user.update', compact('user')) }}" onsubmit="return confirm('Are you sure you would like to reset your settings?');" id="reset-user-form">
            @csrf
            
            <input type="text" name="name" value="{{ $user->name }}" hidden>
            <input type="text" name="gender" value="{{ App\Enums\Gender::UNSPECIFIED->value }}" hidden>
            <input type="text" name="age_category" value="{{ App\Enums\AgeCategory::DEFAULT->value }}" hidden>

            <input type="number" name="max_calories" value="2000" hidden>

            <input type="number" step="0.1" name="med_total_fat_boundary" value="3" hidden>
            <input type="number" step="0.1" name="high_total_fat_boundary" value="17.5" hidden>
            <input type="number" step="0.1" name="max_total_fat" value="70" hidden>

            <input type="number" step="0.1" name="med_saturated_fat_boundary" value="1.5" hidden>
            <input type="number" step="0.1" name="high_saturated_fat_boundary" value="5" hidden>
            <input type="number" step="0.1" name="max_saturated_fat" value="20" hidden>

            <input type="number" step="0.1" name="med_total_sugar_boundary" value="5" hidden>
            <input type="number" step="0.1" name="high_total_sugar_boundary" value="22.5" hidden>
            <input type="number" step="0.1" name="max_total_sugar" value="90" hidden>
            
            <input type="number" step="0.1" name="med_salt_boundary" value="0.3" hidden>
            <input type="number" step="0.1" name="high_salt_boundary" value="1.5" hidden>
            <input type="number" step="0.1" name="max_salt" value="6" hidden>
        </form>

        <div class="mt-8 max-w-xl">
            <h1 class="text-center text-xl font-bold">Credits</h1>
            <div class="flex flex-col gap-y-4 mt-2">
                <div class="flex flex-col gap-y-1">
                    <p>Barcode reader implemented using <span class="font-bold">vue-barcode-reader</span> by Dmytro Olefyrenko and others.</p>
                    <a href="https://github.com/olefirenko/vue-barcode-reader" target="_" class="max-w-max py-0.5 px-1.5 text-center border-2 border-blue-600 focus:ring focus:ring-blue-600 focus:ring-opacity-50">
                        See vue-barcode-reader on GitHub
                    </a>
                </div>
                <div class="flex flex-col gap-y-1">
                    <p>Product data from <span class="font-bold">Open Food Facts</span> Database.</p>
                    <a href="https://openfoodfacts.org/" target="_" class="max-w-max py-0.5 px-1.5 text-center border-2 border-blue-600 focus:ring focus:ring-blue-600 focus:ring-opacity-50">
                        Go to Open Food Facts website
                    </a>
                </div>
                <div class="flex flex-col gap-y-1">
                    <p>Access to Open Food Facts database through <span class="font-bold">Laravel Open Food Facts API</span> on GitHub.</p>
                    <a href="https://github.com/openfoodfacts/openfoodfacts-laravel" target="_" class="max-w-max py-0.5 px-1.5 text-center border-2 border-blue-600 focus:ring focus:ring-blue-600 focus:ring-opacity-50">
                        See Laravel Open Food Facts API on GitHub
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
