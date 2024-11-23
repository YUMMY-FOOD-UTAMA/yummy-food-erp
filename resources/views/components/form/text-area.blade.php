@if($viewOnly)
    <div {{$attributes->merge(['class' => ''])}}>
        <label for="{{$id}}" class="form-label">{{$label}}
            @if($tooltip)
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="{{$tooltip}}"></i>
            @endif
        </label>
        <textarea class="form-control form-control-solid" name="{{$name}}" disabled
                  data-kt-autosize="true" id="{{$id}}">{{$defaultValue}}</textarea>
    </div>
@else
    <div {{$attributes->merge(['class' => ''])}}>
        <label for="{{$id}}" class="form-label">
            <span class="{{$required ? 'required' :''}}">{{$label}}</span>
            @if($tooltip)
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="{{$tooltip}}"></i>
            @endif
        </label>
        <textarea class="form-control form-control-solid" rows="{{$row}}" name="{{$name}}" id="{{$id}}"
                  data-kt-autosize="{{$autoResize}}" {{$required ? 'required' :''}}>{{old($name,$defaultValue)}}</textarea>
        <x-input-error :messages="$errors->get($name)" class="mt-2"></x-input-error>
    </div>
@endif
