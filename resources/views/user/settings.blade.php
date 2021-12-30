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

                        <div>
                            <label for="max_calories">Maximum Calories</label>
                            <p>{{ $ageCategory->minCategoryIntake($gender, 'max_calories') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_calories') }}</p>
                            <input type="number" name="max_calories" value="{{ $user->intakeProfile->max_calories }}">
                        </div>

                        <div>
                            <label for="max_">Maximum Total Fat</label>
                            <p>{{ $ageCategory->minCategoryIntake($gender, 'max_total_fat') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_fat') }}</p>
                            <input type="number" name="max_total_fat" value="{{ $user->intakeProfile->max_total_fat }}">
                        </div>

                        <div>
                            <label for="max_">Maximum Saturated Fat</label>
                            <p>{{ $ageCategory->minCategoryIntake($gender, 'max_saturated_fat') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_saturated_fat') }}</p>
                            <input type="number" name="max_saturated_fat" value="{{ $user->intakeProfile->max_saturated_fat }}">
                        </div>

                        <div>
                            <label for="max_">Maximum Total Sugar</label>
                            <p>{{ $ageCategory->minCategoryIntake($gender, 'max_total_sugar') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_total_sugar') }}</p>
                            <input type="number" name="max_total_sugar" value="{{ $user->intakeProfile->max_total_sugar }}">
                        </div>

                        <div>
                            <label for="max_">Maximum Salt</label>
                            <p>{{ $ageCategory->minCategoryIntake($gender, 'max_salt') }} to {{ $ageCategory->maxCategoryIntake($gender, 'max_salt') }}</p>
                            <input type="number" name="max_salt" value="{{ $user->intakeProfile->max_salt }}">
                        </div>

                        <input type="submit" value="Save Settings">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
