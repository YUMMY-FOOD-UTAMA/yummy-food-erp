@props([
    'type'=>null,
    'required'=>false,
    'name'=>null,
    'tooltip'=>null,
    'placeholder'=>true,
    'label'=>null,
    'uuid'=> "a".\Ramsey\Uuid\Uuid::uuid4()->toString(),
    'id'=>'',
    'sizeForm'=>'lg',
    'defaultValue'=>null,
])

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
           name="{{$name}}" value="{{old($name,$defaultValue)}}" id="{{$id.$uuid}}"/>
    <x-input-error :messages="$errors->get($name)" class="mt-2"></x-input-error>
</div>

@push('script')
    @if($type=='phone_number')
        <script>
            new Inputmask({
                "mask": "(+62) 999-9999-9999",
                "placeholder": "(+62) 888-8888-8888",
            }).mask("#{{$id.$uuid}}");
        </script>
    @elseif($type=='rt_rw')
        <script>
            new Inputmask({
                "mask": "999/999",
                "placeholder": "002/003",
            }).mask("#{{$id.$uuid}}");
        </script>
    @endif
@endpush
