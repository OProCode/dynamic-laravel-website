<x-app-layout>

        <x-slot name="header">
            <div class="text-center">
                <p class="text-m text-gray-200">Welcome to</p>
                <h1 class="text-6xl uppercase mt-2">{{ env('APP_NAME') }}</h1>
                <p class="text-2xl mt-5 text-gray-200">The Totally Huge Resource Of Acronyms and Terms</p>
            </div>
        </x-slot>

        <x-slot name="slot">
            <div class="text-center items-center">
                @if(Auth::user())
                    <p class="m-5">Welcome back, {{ Auth::user()->name }}!</p>
                @else
                    <p class="m-5">As a guest, you can browse the following tables:</p>
                    <x-nav-link :href="route('words.index')">
                        {{ __('Words') }}
                    </x-nav-link>
                    <x-nav-link :href="route('definitions.index')">
                        {{ __('Definitions') }}
                    </x-nav-link>
                    <p class="m-5">Login or register to get access to more tables!</p>
                @endif
            </div>

        </x-slot>

</x-app-layout>
