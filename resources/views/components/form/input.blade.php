@if($viewOnly)
    <div {{$attributes->merge(['class' => ''])}}>
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">{{$label}}
            @if($tooltip)
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="{{$tooltip}}"></i>
            @endif
        </label>
        <input type="text" disabled class="form-control form-control-solid form-control-{{$sizeForm}}"
               name="{{$name}}" value="{{$defaultValue}}"/>
    </div>
@else
    <div {{$attributes->merge(['class' => ''])}}>
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
            <span class="{{$required ? 'required' : ''}}">{{$label}}</span>
            @if($tooltip)
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="{{$tooltip}}"></i>
            @endif
        </label>
        <input type="{{$type == "date"? "text": $type}}"
               {{$required ? 'required':''}} class="form-control form-control-solid form-control-{{$sizeForm}}"
               placeholder="{{$placeholder}}"
               name="{{$name}}" value="{{old($name,$defaultValue)}}" id="{{$id.$uuid}}"/>
        <x-input-error :messages="$errors->get($name)" class="mt-2"></x-input-error>
    </div>
    @push('script')
        @if($type == "date")
            <script>
                $("#{{$id.$uuid}}").daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        minYear: 1901,
                        locale: {
                            format: 'YYYY-MM-DD'
                        },
                        maxYear: parseInt(moment().format("YYYY"), 12)
                    }, function (start, end, label) {
                    }
                );
            </script>
        @endif
    @endpush
@endif
