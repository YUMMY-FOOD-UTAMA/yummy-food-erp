<form id="{{$id}}" action="{{url()->current()}}">
    <div {{ $attributes->merge(['class' => 'row']) }}>
        <div class="col-12 {{ $usingApplyButton ? 'col-md-10' : '' }} mb-3">
            <div class="row">
                {{$slot}}
            </div>
        </div>
        @if ($usingApplyButton)
            <div class="col-12 col-md-2 mt-0 mt-md-8 d-flex flex-row align-items-start gap-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">Apply Filter</button>
                <button type="button" id="resetFilter" class="btn btn-success btn-sm w-100">Reset Filter</button>
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

        document.getElementById('resetFilter').addEventListener('click', function() {
            const url = new URL(window.location);
            url.search = '';
            window.history.replaceState({}, '', url);

            window.location.reload();
        });
        @endif
    </script>
@endpush
