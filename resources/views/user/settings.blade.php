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

                    <form method="POST" action="{{ route('user.update', compact('user')) }}">
                        @csrf

                        <label for="name">Name</label><br>
                        <input type="text" name="name" value="{{ $user->name }}"><br>

                        <label for="gender">Gender</label><br>
                        <select name="gender">
                            @foreach (array_column(App\Enums\Gender::cases(), 'value') as $gender)
                            <option value="{{ $gender }}" @if ($user->gender == $gender) selected @endif>
                                {{ ucfirst($gender) }}
                            </option>
                            @endforeach
                            <option value="{{ null }}" @if ($user->gender == null) selected @endif>
                                Unspecified
                            </option>
                        </select><br>
                        
                        <label for="age_category">Age Category</label><br>
                        <select name="age_category">
                            @foreach (config('constants.age_categories') as $ageCategory)
                                <option value="{{ $ageCategory }}" @if (strcmp($user->age_category, $ageCategory) == 0) selected @endif>
                                    {{ $ageCategory }}
                                </option>
                            @endforeach
                        </select><br>

                        <input type="submit" value="Save Settings">
                    </form>

                    {{-- <p>{{ App\Enums\Gender::MALE }}</p> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
