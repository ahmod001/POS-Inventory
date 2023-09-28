<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title></title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}" />
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

</head>

<body>

    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <nav class="navbar fixed-top px-0 shadow-sm bg-white">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                <span class="icon-nav m-0 h5" onclick="MenuBarClickHandler()">
                    <img class="nav-logo-sm mx-2" src="{{ asset('images/menu.svg') }}" alt="logo" />
                </span>
                <img class="nav-logo  mx-2" src="{{ asset('images/logo.png') }}" alt="logo" />
            </a>

            <div class="float-right h-auto d-flex">
                <div class="user-dropdown">
                    <img class="icon-nav-img" src="{{ asset('images/user.webp') }}" alt="" />
                    <div class="user-dropdown-content ">
                        <div class="mt-4 text-center">
                            <img class="icon-nav-img" src="{{ asset('images/user.webp') }}" alt="" />
                            <h6>User Name</h6>
                            <hr class="user-dropdown-divider  p-0" />
                        </div>
                        <a href="{{ url('/user-profile') }}" class="side-bar-item">
                            <span class="side-bar-item-caption">Profile</span>
                        </a>
                        <a href="{{url('/user-logout')}}" class="side-bar-item">
                            <span class="side-bar-item-caption">Logout</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div id="sideNavRef" class="side-nav-open">
        <a href="{{ url('/') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption text-lg">Dashboard</span>
        </a>

        <a href="{{ url('/customers') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption text-lg">Customers</span>
        </a>

        <a href="{{ url('/categories') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption text-lg">Categories</span>
        </a>

        <a href="{{ url('/products') }}" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption text-lg">Products</span>
        </a>


        <a href="#Getting-Started" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption text-lg">Invoice</span>
        </a>

        <a href="#Getting-Started" class="side-bar-item">
            <i class="fa fa-chevron-circle-right  text-dark"></i>
            <span class="side-bar-item-caption text-lg">Report</span>
        </a>
    </div>


    <div id="contentRef" class="content">
        @yield('content')
    </div>


    <script>
        function MenuBarClickHandler() {
            let sideNav = document.getElementById('sideNavRef');
            let content = document.getElementById('contentRef');
            if (sideNav.classList.contains("side-nav-open")) {
                sideNav.classList.add("side-nav-close");
                sideNav.classList.remove("side-nav-open");
                content.classList.add("content-expand");
                content.classList.remove("content");
            } else {
                sideNav.classList.remove("side-nav-close");
                sideNav.classList.add("side-nav-open");
                content.classList.remove("content-expand");
                content.classList.add("content");
            }
        }
    </script>


    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/form-validation.js') }}"></script>
    <script src="{{ asset('js/toastify-js.js') }}"></script>
</body>

</html>
