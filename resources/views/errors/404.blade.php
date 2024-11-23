<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta-html')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
<script>var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }</script>
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>body {
            background-image: url('{{asset('assets/media/auth/bg1.jpg')}}');
        }

        [data-bs-theme="dark"] body {
            background-image: url('{{asset('assets/media/auth/bg1-dark.jpg')}}');
        }</style>
    <div class="d-flex flex-column flex-center flex-column-fluid">
        <div class="d-flex flex-column flex-center text-center p-10">
            <div class="card card-flush w-lg-650px py-5">
                <div class="card-body py-15 py-lg-20">
                    <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                    <div class="fw-semibold fs-6 text-gray-500 mb-7">page not found.
                    </div>
                    <div class="mb-3">
                        <img src="{{asset('assets/media/auth/404-error.png')}}" class="mw-100 mh-300px theme-light-show"
                             alt=""/>
                        <img src="{{asset('assets/media/auth/404-error-dark.png')}}"
                             class="mw-100 mh-300px theme-dark-show" alt=""/>
                    </div>
                    <div class="mb-0">
                        <a href="javascript:history.back()" class="btn btn-sm btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>var hostUrl = "assets/";</script>
<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
</body>
</html>
