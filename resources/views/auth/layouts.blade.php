<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title') | POS Admin Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

</head>

<body class="account-page">

    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        @yield('content')
    </div>
    <!-- /Main Wrapper -->
    <div class="customizer-links" id="setdata">
        <ul class="sticky-sidebar">
            <li class="sidebar-icons">
                <a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
                    data-bs-original-title="Theme">
                    <i data-feather="settings" class="feather-five"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- jQuery Validation Plugin -->
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/theme-script.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/auth-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        function showToast(message, type = 'success') {
            let bgColor = type === 'success' ? "green" : "red";

            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: bgColor,
                stopOnFocus: true,
                closable: true,
            }).showToast();
        }
    </script>
    @if (session('success'))
        <script>
            showToast("{{ session('success') }}", "success");
        </script>
    @endif

    @if (session('error'))
        <script>
            showToast("{{ session('error') }}", "error");
        </script>
    @endif

    @if (session(('warning')))
        <script>
            showToast("{{ session('warning') }}", "warning");
        </script>    
    @endif


</body>

</html>
