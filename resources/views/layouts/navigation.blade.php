<nav x-data="{ open: false }" class="bg-gray-800 dark:bg-gray-300 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex sm:items-center">
                    <x-nav-link :href="route('static.home')" :active="request()->routeIs('static.home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('static.privacy')" :active="request()->routeIs('static.privacy')">
                        {{ __('Privacy') }}
                    </x-nav-link>
                    <x-nav-link :href="route('static.contact')" :active="request()->routeIs('static.contact')">
                        {{ __('Contact') }}
                    </x-nav-link>
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 text-gray-300 dark:text-gray-600 hover:text-gray-500 dark:hover:text-gray-900">
                                    <div>Tables</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            @auth()

                                @if(Auth::user()->hasRole('admin'))
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('words.index')">
                                            {{ __('Words') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('wordtypes.index')">
                                            {{ __('Word Types') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('definitions.index')">
                                            {{ __('Definitions') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('ratings.index')">
                                            {{ __('Ratings') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('users.index')">
                                            {{ __('Users') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                @elseif(Auth::user()->hasRole(['staff']))
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('words.index')">
                                                {{ __('Words') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('definitions.index')">
                                            {{ __('Definitions') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('users.index')">
                                            {{ __('Users') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                @elseif(Auth::user()->hasRole(['user']))
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('words.index')">
                                            {{ __('Words') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('definitions.index')">
                                            {{ __('Definitions') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                @endauth
                                @elseif(!Auth::user())
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('words.index')">
                                            {{ __('Words') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('definitions.index')">
                                            {{ __('Definitions') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                @endif
                        </x-dropdown>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth()
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 dark:text-gray-600 hover:text-gray-500 dark:hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    @if (Route::has('login'))
                        <div class="p-6 text-right z-10">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('static.home')" :active="request()->routeIs('static.home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('static.privacy')" :active="request()->routeIs('static.privacy')">
                {{ __('Privacy') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('static.contact')" :active="request()->routeIs('static.contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>

            @auth()
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('words.index')" :active="request()->routeIs('words.index')">
                    {{ __('Words') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('wordtypes.index')" :active="request()->routeIs('wordtypes.index')">
                    {{ __('Word Types') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('ratings.index')" :active="request()->routeIs('ratings.index')">
                    {{ __('Ratings') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                @auth
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
