<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Members') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        <div class="admin-dashboard">
                            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                                <!-- Primary Navigation Menu -->
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                    <div class="flex justify-between h-16">
                                        <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                            <x-nav-link :href="route('makati.index')" :active="request()->routeIs('makati.index')">
                                                {{ __('MAKATI') }}
                                            </x-nav-link>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex" style="text-decoration: none">
                                            <x-nav-link :href="route('pampanga.index')" :active="request()->routeIs('pampanga.index')">
                                                {{ __('PAMPANGA') }}
                                            </x-nav-link>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex" style="text-decoration: none">
                                            <x-nav-link :href="route('cebu.index')" :active="request()->routeIs('cebu.index')">
                                                {{ __('CEBU') }}
                                            </x-nav-link>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex" style="text-decoration: none">
                                            <x-nav-link :href="route('bohol.index')" :active="request()->routeIs('bohol.index')">
                                                {{ __('BOHOL') }}
                                            </x-nav-link>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex" style="text-decoration: none">
                                            <x-nav-link :href="route('other.index')" :active="request()->routeIs('other.index')">
                                                {{ __('OTHER BRANCH') }}
                                            </x-nav-link>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </nav>
                        <br>
                        <!-- Main Content Section -->
                        <main class="admin-content">
                            <!-- This is where the content from child views will be injected -->
                            @yield('content')
                        </main>
                    </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
                </script>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
