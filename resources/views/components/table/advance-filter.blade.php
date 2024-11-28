<form action="{{url()->current()}}">
    <div class="row p-10">
        <div class="col-12 {{ $usingApplyButton ? 'col-md-10' : '' }} mb-3">
            <div class="row">
                {{$slot}}

                <div class="col-12 col-md-3 mb-3">
                    <label class="form-label">Visit Range Date</label>
                    <input class="form-control form-control-solid form-control-sm" placeholder="Pick date rage"
                           id="kt_daterangepicker_1"/>
                </div>

            </div>
        </div>
        @if ($usingApplyButton)
            <div class="col-12 col-md-2 mt-0 mt-md-8">
                <button type="button" class="btn btn-primary btn-sm w-100">Apply</button>
            </div>
        @endif
    </div>

</form>
@push('script')
    <script>
        $("#kt_daterangepicker_1").daterangepicker();
    </script>
@endpush
