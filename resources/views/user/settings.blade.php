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
                    <form method="POST" action="{{ route('settings') }}">
                        <label for="gender">Gender</label><br>
                        <select name="gender">
                            @foreach (config('constants.genders') as $gender)
                                <option value="{{ $gender }}">
                                    {{ ucfirst($gender) }}
                                </option>
                            @endforeach
                        </select><br>

                        <label for="age-category">Age Category</label><br>
                        <select name="age-category">
                            @foreach (config('constants.age_categories') as $ageCategory)
                                {{-- <option value="{{ $ageCategory }}" {{ @if ($user->ageCategory == $ageCategory) selected @endif}}> --}}
                                <option value="{{ $ageCategory }}"}}>
                                    {{ $ageCategory }}
                                </option>
                            @endforeach
                        </select><br>

                        <input type="submit" value="Save Settings">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
