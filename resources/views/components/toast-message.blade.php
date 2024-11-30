@push('script')
    <script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toastr-top-center",
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
@endpush
@if(session('status'))
    @push('script')
        <script>
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
