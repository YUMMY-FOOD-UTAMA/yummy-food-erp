@props([
    'placeholder' =>'Choose Or Add Item',
    'id'=>"a".\Ramsey\Uuid\Uuid::uuid4()->toString(),
    'label'=>null,
    'required'=>false,
    'type'=>'inline',
    'sizeForm'=>'lg',
    'items'=>null,
    'name'=>null,
    'dropDownParentID'=>'',
    'defaultValue'=>null,
    'tooltip'=>null
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
                    data-dropdown-parent="{{$dropDownParentID}}"
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
                data-dropdown-parent="{{$dropDownParentID}}"
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
