@push('script')
    <script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toastr-top-center",
            "preventDuplicates": true,
            "showDuration": "5000000",
            "hideDuration": "5000000",
            "timeOut": "5000000",
            "extendedTimeOut": "5000000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "enableHtml": true,
        };
    </script>
@endpush
@if(session('status'))
    @push('script')
        <script>
            @switch(session('status'))
            @case('error')
            toastr.error(`{!! session('message') !!}`);
            @break
            @case('info')
            toastr.info("{{session('message')}}");
            @break
            @case('warning')
            toastr.warning("{{session('message')}}");
            @break
            @default
            toastr.success("{{session('message')}}");
            @break
            @endswitch
        </script>
    @endpush
@endif
