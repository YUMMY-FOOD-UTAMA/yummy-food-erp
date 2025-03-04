@props([
    'placeholder' =>'Choose Or Add Item',
    'id'=>'',
    'label'=>null,
    'required'=>false,
    'type'=>'inline',
    'sizeForm'=>'lg',
    'items'=>null,
    'name'=>null,
    'dropDownParentId'=>'',
    'defaultValue'=>null,
    'tooltip'=>null,
    'errorMessageId'=>''
])
@php
    $defaultValueExists = false;
@endphp

@foreach($items as $item)
    @if($item->id == $defaultValue)
        @php
            $defaultValueExists = true;
        @endphp
    @endif
@endforeach

<div {{$attributes->merge(['class' => ''])}}>
    @if($type == "inline")
        <label class="col-lg-4 col-form-label fw-semibold fs-6">
            <span class="{{$required ? 'required' : ''}}">{{$label}}</span>
            @if($tooltip)
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="{{$tooltip}}"></i>
            @endif
        </label>
        <div class="col-lg-8 fv-row">
            <select name="{{$name}}" aria-label="Select a {{$label}}" id="{{$id}}"
                    data-dropdown-parent="{{$dropDownParentId}}"
                    class="form-select form-select-solid form-select-{{$sizeForm}}">
                @if(!$defaultValueExists)
                    <option value="{{$defaultValue}}">{{$defaultValue != '' ? $defaultValue : $placeholder}}</option>
                @endif
                @foreach($items as $item)
                    <option value="{{$item->id}}" @selected(old($name, $defaultValue) == $item->id)>
                        {{$item->name}}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get($name)" class="mt-2"></x-input-error>
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
            <span class="{{$required ? 'required' : ''}}">{{$label}}</span>
            @if($tooltip)
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="{{$tooltip}}"></i>
            @endif
        </label>
        <select name="{{$name}}" aria-label="Select a {{$label}}" id="{{$id}}"
                data-dropdown-parent="{{$dropDownParentId}}"
                class="form-select form-select-solid form-select-{{$sizeForm}}">
            @if(!$defaultValueExists)
                <option value="{{$defaultValue}}">{{$defaultValue != '' ? $defaultValue : $placeholder}}</option>
            @endif
            @foreach($items as $item)
                <option value="{{$item->id}}" @selected(old($name, $defaultValue) == $item->id)>
                    {{$item->name}}
                </option>
            @endforeach
        </select>
        <ul class="error-message text-sm text-red-600 dark:text-red-400 space-y-1" style="display: none"
            id="{{$errorMessageId}}">
        </ul>
    @endif
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#{{$id}}').select2({
                placeholder: '{{$placeholder}}',
                tags: true,
                allowClear: true
            });
        });
    </script>
@endpush
