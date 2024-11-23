<div {{$attributes->merge(['class' => ''])}}>
    @if($type == "inline")
        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Time
            Zone</label>
        <div class="col-lg-8 fv-row">
            <select name="timezone" aria-label="Select a Timezone" data-allow-clear="true"
                    data-control="select2" data-placeholder="Select a timezone.."
                    data-dropdown-parent="{{$dropDownParentID}}"
                    class="form-select form-select-solid form-select-lg">
                <option value="">Select a Timezone..</option>
                @foreach($timezones as $t)
                    <option value="{{$t->id}}" @selected(old('timezone', $timezone) == $t->id)>
                        {{$t->name}}
                    </option>
                @endforeach
            </select>
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 required fw-semibold mb-2">Timezone</label>
        <select name="timezone" aria-label="Select a Timezone" data-allow-clear="true"
                data-dropdown-parent="{{$dropDownParentID}}"
                data-control="select2" data-placeholder="Select a timezone.."
                class="form-select form-select-solid form-select-lg">
            <option value="">Select a Timezone..</option>
            @foreach($timezones as $t)
                <option value="{{$t->id}}" @selected(old('timezone', $timezone) == $t->id)>
                    {{$t->name}}
                </option>
            @endforeach
        </select>
    @endif
</div>
