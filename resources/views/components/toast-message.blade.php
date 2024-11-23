@if(session('status'))
    @push('script')
        <script>
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toastr-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            @switch(session('status'))
            @case('error')
            toastr.error("{{session('message')}}");
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
