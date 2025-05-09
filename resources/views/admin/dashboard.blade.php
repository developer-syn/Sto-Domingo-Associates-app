<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Dashboard' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- This is the layout for admin dashboard -->
                    <body>
                        <div class="admin-dashboard">
                            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                                <!-- Primary Navigation Menu -->
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                    <div class="flex justify-between h-16">
                                        <div class="flex">
                                            <!-- Conditionally display links -->
                                            @unless (request()->routeIs('cebu.index'))
                                                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                                    style="text-decoration: none">
                                                    <x-nav-link :href="route('employees.index')" :active="request()->routeIs('employees.index')">
                                                        {{ __('Employees') }}
                                                    </x-nav-link>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;
                                                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                                    style="text-decoration: none">
                                                    <x-nav-link :href="route('employees.create')" :active="request()->routeIs('employees.create')">
                                                        {{ __('Add Employee') }}
                                                    </x-nav-link>
                                                </div>
                                            @endunless
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

                        <script src="{{ asset('js/app.js') }}"></script> <!-- Add your JS -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
                        </script>
                    </body>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
