@props([
    'name'=>'gender',
    'defaultValue'=>null,
    'label'=>'Gender'
])
<div {{ $attributes->merge(['class' => '']) }}>
    <label class="fs-6 fw-semibold mb-2">{{$label}}
        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
           title="Show your ads to either men or women, or select 'All' for both"></i>
    </label>
    <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button='true']">
        <div class="col">
            <label
                class="btn btn-outline btn-outline-dashed btn-active-light-primary {{old('gender',$defaultValue) == 'Male' ? 'active':''}} d-flex text-start p-6"
                data-kt-button="true">
                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                    <input class="form-check-input" type="radio"
                           {{old($name,$defaultValue) == 'Male' ? 'checked':''}}
                           name="{{$name}}" value="Male"/>
                </span>
                <span class="ms-5">
                    <span class="fs-4 fw-bold text-gray-800 d-block">Male</span>
                </span>
            </label>
        </div>
        <div class="col">
            <label
                class="btn btn-outline btn-outline-dashed btn-active-light-primary {{old('gender',$defaultValue) == 'Female' ? 'active':''}} d-flex text-start p-6"
                data-kt-button="true">
                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                    <input class="form-check-input" type="radio"
                           {{old($name,$defaultValue) == 'Female' ? 'checked':''}}
                           name="{{$name}}" value="Female"/>
                </span>
                <span class="ms-5">
                    <span
                        class="fs-4 fw-bold text-gray-800 d-block">Female</span>
                </span>
            </label>
        </div>
    </div>
</div>
