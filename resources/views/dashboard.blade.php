<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('DASHBOARD') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-start w-full">
            <h1 class="ml-6">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="ml-6 mt-6">Your tables:</p>

            <div class="ml-6 mt-2 space-x-6">
                @if(Auth::user()->hasRole('admin'))
                    <x-nav-link  class="hover:text-orange-400" :href="route('words.index')">
                        {{ __('Words') }}
                    </x-nav-link>
                    <x-nav-link :href="route('wordtypes.index')">
                        {{ __('Word Types') }}
                    </x-nav-link>
                    <x-nav-link :href="route('definitions.index')">
                        {{ __('Definitions') }}
                    </x-nav-link>
                    <x-nav-link :href="route('ratings.index')">
                        {{ __('Ratings') }}
                    </x-nav-link>
                    <x-nav-link :href="route('users.index')">
                        {{ __('Users') }}
                    </x-nav-link>
                @elseif(Auth::user()->hasRole(['staff', 'user']))
                    <x-nav-link :href="route('words.index')">
                        {{ __('Words') }}
                    </x-nav-link>
                    <x-nav-link :href="route('definitions.index')">
                        {{ __('Definitions') }}
                    </x-nav-link>
                    <x-nav-link :href="route('users.index')">
                        {{ __('Users') }}
                    </x-nav-link>
                @endif
            </div>

        </div>

    </x-slot>
</x-app-layout>
