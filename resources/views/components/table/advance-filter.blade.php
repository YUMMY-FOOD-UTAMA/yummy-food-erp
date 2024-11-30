<form id="{{$id}}" action="{{url()->current()}}">
    <div {{ $attributes->merge(['class' => 'row']) }}>
        <div class="col-12 {{ $usingApplyButton ? 'col-md-10' : '' }} mb-3">
            <div class="row">
                {{$slot}}
            </div>
        </div>
        @if ($usingApplyButton)
            <div class="col-12 col-md-2 mt-0 mt-md-8">
                <button type="submit" class="btn btn-primary btn-sm w-100">Apply</button>
            </div>
        @endif
    </div>

</form>
@push('script')
    <script>
        @if($usingApplyButton)
        document.getElementById('{{$id}}').addEventListener('submit', function (event) {
            event.preventDefault();
            appendQueryParams(this);
        });
        @endif
    </script>
@endpush
