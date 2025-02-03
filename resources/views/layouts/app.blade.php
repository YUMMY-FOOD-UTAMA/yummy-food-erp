<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.meta-html')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet" type="text/css"/>
    @stack('css')
</head>
<style>
</style>
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
      data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
      data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
      data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<x-toast-message></x-toast-message>
<!--begin::Theme mode setup on page load-->
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

<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include('layouts.header')
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('layouts.sidebar')
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>

<script>
    function appendQueryParams(form) {
        let url = new URL(form.action);
        let params = new URLSearchParams(window.location.search);

        let formData = new FormData(form);
        for (let pair of formData.entries()) {
            let key = pair[0];
            let value = pair[1].trim();

            params.set(key, value || '');
        }

        window.location.href = url.origin + url.pathname + '?' + params.toString();
    }

    function handleSelectChangeQueryParams(selectElement) {
        const selectedValue = selectElement.value;
        const selectId = selectElement.id;
        const selectName = selectElement.name;

        console.log(`Selected ${selectId}: ${selectedValue}`);

        const currentUrl = new URL(window.location.href);

        if (selectedValue) {
            currentUrl.searchParams.set(selectName, selectedValue);
        } else {
            currentUrl.searchParams.delete(selectName);
        }

        window.location.href = currentUrl.toString();
    }

    function handleInputChangeQueryParams(inputElement) {
        const inputValue = inputElement.value;
        const selectName = inputElement.name;

        const currentUrl = new URL(window.location.href);

        if (inputValue) {
            currentUrl.searchParams.set(selectName, inputValue);
        } else {
            currentUrl.searchParams.delete(selectName);
        }

        window.location.href = currentUrl.toString();
    }
</script>
@stack('script')
</body>
</html>
