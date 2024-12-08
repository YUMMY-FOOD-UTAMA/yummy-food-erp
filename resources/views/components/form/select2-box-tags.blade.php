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
        <label class="col-lg-4 col-form-label {{$required ? 'required':''}} fw-semibold fs-6">{{$label}}</label>
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
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 {{$required?'required':''}} fw-semibold mb-2">{{$label}}</label>
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
