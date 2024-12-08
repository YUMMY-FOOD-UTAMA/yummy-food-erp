<div {{ $attributes->merge(['class' => 'form-check form-check-custom form-check-solid form-check-sm form-check-success']) }}>
    <input
        class="form-check-input"
        type="checkbox"
        name="{{$name}}"
        id="{{ $id }}"
        value="{{ $value }}"
        @checked($checked)
    >
    <label class="form-check-label text-black" for="{{ $id }}">
        {{ $slot }}
    </label>
</div>
