<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- resources/views/admin/dashboard.blade.php -->

                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Admin Dashboard</title>
                        {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Add your CSS --> --}}
                    </head>

                    <body>
                        <div class="admin-dashboard">
                            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
                                <!-- Primary Navigation Menu -->
                                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                    <div class="flex justify-between h-16">
                                        <div class="flex">
                                            {{-- <li><a href="{{ route('employees.index') }}" style="font-weight: bolder;">Employees</a></li> --}}
                                            <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                                style="text-decoration: none">
                                                <x-nav-link :href="route('news.index')" :active="request()->routeIs('news.index')"
                                                    style="text-decoration: none">
                                                    {{ __('News') }}
                                                </x-nav-link>
                                            </div>
                                            &nbsp;&nbsp;&nbsp;
                                            <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                                style="text-decoration: none">
                                                <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')"
                                                    style="text-decoration: none">
                                                    {{ __('Events') }}
                                                </x-nav-link>
                                            </div>
                                            &nbsp;&nbsp;&nbsp;
                                            <div class=" space-x-8 sm:-my-px sm:ms-10 sm:flex"
                                                style="text-decoration: none">
                                                <x-nav-link :href="route('triumphs.index')" :active="request()->routeIs('triumphs')"
                                                    style="text-decoration: none">
                                                    {{ __('Triumphs') }}
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

                        <script src="{{ asset('js/app.js') }}"></script> <!-- Add your JS -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
                        </script>
                    </body>

                    </html>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
