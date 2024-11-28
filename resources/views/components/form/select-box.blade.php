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
            <select name="{{$name}}" aria-label="{{$placeholder}}" data-allow-clear="true"
                    data-control="select2" data-placeholder="{{$placeholder}}"
                    data-dropdown-parent="{{$dropDownParentID}}" {{$required ? 'required':''}}
                    class="form-select form-select-solid form-select-{{$sizeForm}}">
                <option value="">{{$placeholder}}</option>
                @foreach($items as $t)
                    <option value="{{$t->$valueKey}}" @selected(old($name, $defaultValue) == $t->$valueKey)>
                        @if($customNameKey)
                            {{ eval('return ' . str_replace('$t', '$t', $customNameKey) . ';') }}
                        @else
                            {{$t->$nameKey}}
                        @endif
                    </option>
                @endforeach
            </select>
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
            <span class="{{$required ? 'required' : ''}}">{{$label}}</span>
            @if($tooltip)
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                   title="{{$tooltip}}"></i>
            @endif
        </label>
        <select name="{{$name}}" aria-label="{{$placeholder}}" data-allow-clear="true"
                data-control="select2" data-placeholder="{{$placeholder}}"
                data-dropdown-parent="{{$dropDownParentID}}" {{$required ? 'required':''}}
                class="form-select form-select-solid form-select-{{$sizeForm}}">
            <option value="">{{$placeholder}}</option>
            @foreach($items as $t)
                <option value="{{$t->$valueKey}}" @selected(old($name, $defaultValue) == $t->$valueKey)>
                    @if($customNameKey)
                        {{ eval('return ' . str_replace('$t', '$t', $customNameKey) . ';') }}
                    @else
                        {{$t->$nameKey}}
                    @endif
                </option>
            @endforeach
        </select>
    @endif
</div>
