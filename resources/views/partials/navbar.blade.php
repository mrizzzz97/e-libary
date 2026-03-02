<nav class="bg-gray-800" x-data="{ isOpen: false, profileOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">

            <!-- Logo & Menu -->
            <div class="flex items-center">
                <div class="shrink-0">
                    <a href="/">
                        <img class="size-8"
                             src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                             alt="Logo">
                    </a>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/"
                           class="rounded-md px-3 py-2 text-sm font-medium {{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            Homepage
                        </a>

                        <a href="/hall"
                           class="rounded-md px-3 py-2 text-sm font-medium {{ request()->is('hall*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            Hall
                        </a>

                        <a href="/about"
                           class="rounded-md px-3 py-2 text-sm font-medium {{ request()->is('about*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            About
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">

                    @auth
                    <!-- Profile Dropdown -->
                    <div class="relative ml-3">
                        <button @click="profileOpen = !profileOpen"
                                class="relative flex items-center rounded-full bg-gray-800 text-sm focus:outline-none">
                            <img class="size-8 rounded-full"
                                 src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                                 alt="Profile">
                        </button>

                        <div x-show="profileOpen"
                             @click.away="profileOpen = false"
                             class="absolute right-0 z-10 mt-2 w-48 rounded-md bg-white py-1 shadow-lg">

                            <div class="px-4 py-2 border-b">
                                <div class="text-sm font-semibold text-gray-800">
                                    {{ auth()->user()->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>

                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                    @endauth

                    @guest
                        <a href="/login"
                           class="bg-indigo-500 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-600">
                            Login
                        </a>
                    @endguest

                </div>
            </div>

            <!-- Mobile Button -->
            <div class="-mr-2 flex md:hidden">
                <button @click="isOpen = !isOpen"
                        class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white">
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }"
                         class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                    <svg :class="{'block': isOpen, 'hidden': !isOpen }"
                         class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="isOpen" class="md:hidden">
        <div class="space-y-1 px-2 pt-2 pb-3">
            <a href="/" class="block px-3 py-2 text-base text-gray-300 hover:bg-gray-700 hover:text-white">
                Homepage
            </a>
            <a href="/hall" class="block px-3 py-2 text-base text-gray-300 hover:bg-gray-700 hover:text-white">
                Hall
            </a>
            <a href="/about" class="block px-3 py-2 text-base text-gray-300 hover:bg-gray-700 hover:text-white">
                About
            </a>
        </div>

        @auth
        <div class="border-t border-gray-700 pt-4 pb-3">
            <div class="flex items-center px-5">
                <img class="size-10 rounded-full"
                     src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                     alt="Profile">
                <div class="ml-3">
                    <div class="text-base font-medium text-white">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="text-sm text-gray-400">
                        {{ auth()->user()->email }}
                    </div>
                </div>
            </div>

            <div class="mt-3 px-2">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit"
                            class="block w-full text-left px-3 py-2 text-base text-gray-400 hover:bg-gray-700 hover:text-white">
                        Sign out
                    </button>
                </form>
            </div>
        </div>
        @endauth

        @guest
        <div class="border-t border-gray-700 pt-4 pb-3 px-2">
            <a href="/login"
               class="block px-3 py-2 text-base text-white bg-indigo-500 rounded-md text-center">
                Login
            </a>
        </div>
        @endguest

    </div>
</nav>