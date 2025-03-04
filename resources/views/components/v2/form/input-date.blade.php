@props([
    'viewOnly' => false,
    'label' => '',
    'tooltip' => null,
    'sizeForm' => 'lg',
    'name' => '',
    'defaultValue' => '',
    'id' => '',
    'placeholder' => '',
    'required' => false,
    'errorMessageId'=>'',
])

@if($viewOnly)
    <div {{$attributes->merge(['class' => ''])}}>
        @if($label)
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">{{$label}}
                @if($tooltip)
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                       title="{{$tooltip}}"></i>
                @endif
            </label>
        @endif
        <input type="text" disabled class="form-control form-control-solid form-control-{{$sizeForm}}"
               name="{{$name}}" value="{{$defaultValue}}" id="{{$id}}"/>
    </div>
@else
    <div {{$attributes->merge(['class' => ''])}}>
        @if($label)
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="{{$required ? 'required' : ''}}">{{$label}}</span>
                @if($tooltip)
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                       title="{{$tooltip}}"></i>
                @endif
            </label>
        @endif

        <div class="d-flex w-100 align-items-center">
            <input type="text"
                   {{$required ? 'required' : ''}}
                   class="form-control form-control-solid form-control-{{$sizeForm}}"
                   placeholder="{{$placeholder}}"
                   name="{{$name}}"
                   value="{{old($name,$defaultValue)}}"
                   id="{{$id}}"/>
        </div>

        <ul class="error-message text-sm text-red-600 dark:text-red-400 space-y-1" style="display: none"
            id="{{$errorMessageId}}">
        </ul>
    </div>

    @push('script')
        <script>
            $("#{{$id}}").daterangepicker({
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
    @endpush
@endif
