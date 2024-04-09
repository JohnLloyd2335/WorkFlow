<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo-icon.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    @livewireStyles

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-custom">
            <a class="navbar-brand text-light" href="{{ route('home') }}">
                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="Brand Logo" />
                <span id="text-brand" class="ml-1">WorkFlow</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo01">
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('job_seeker.jobs.index') }}">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>

                    @endguest

                    @auth
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('job_seeker.jobs.index') }}">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('job_seeker.application.index') }}">My Application</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('bookmark.index') }}">Bookmark</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('job_seeker.profile.index') }}">Profile</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('job_seeker.account_settings.index') }}">Account Settings</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item" id="logout">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>


        <main class="my-5">
            @yield('content')
        </main>


    </div>

    <footer class="bg-body-tertiary text-center text-lg-start">
        <!-- Grid container -->
        <div class="container-fluid p-4 footer">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase links-title">Links</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-light">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 4</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase links-title mb-0">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="text-light">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 4</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase links-title">Links</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-light">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 4</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase links-title mb-0">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="text-light">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-light">Link 4</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3 copyright">
            © 2024 Copyright:
            <a class="text-light" href="{{ route('home') }}">WorkFlow</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>






    <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>

    <script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
    @livewireScripts

</body>

</html>
