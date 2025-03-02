@props([
    'viewOnly' => false,
    'label' => '',
    'tooltip' => null,
    'sizeForm' => 'lg',
    'name' => '',
    'defaultValue' => '',
    'id' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'mustUpperCase' => false,
    'withClipboard' => false,
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
            <input type="{{$type}}"
                   {{$required ? 'required' : ''}}
                   class="form-control form-control-solid form-control-{{$sizeForm}}"
                   placeholder="{{$placeholder}}"
                   name="{{$name}}"
                   value="{{old($name,$defaultValue)}}"
                   id="{{$id}}"
                   style="{{$mustUpperCase ? 'text-transform: uppercase;' : ''}}"
                   oninput="{{$mustUpperCase ? 'this.value = this.value.toUpperCase();' : ''}}"/>

            @if($withClipboard)
                <a class="btn btn-light-primary ms-2" data-clipboard-target="#{{$id}}">
                    Copy
                </a>
            @endif
        </div>

            <ul class="text-sm text-red-600 dark:text-red-400 space-y-1" style="display: none"
                id="{{$errorMessageId}}">
            </ul>
    </div>

    @push('script')
        @if($withClipboard)
            <script>
                const target = document.getElementById('{{$id}}');
                const button = target.nextElementSibling;

                var clipboard = new ClipboardJS(button, {
                    target: target,
                });

                clipboard.on('success', function (e) {
                    const currentLabel = button.innerHTML;

                    if (button.innerHTML === 'Copied!') {
                        return;
                    }

                    button.innerHTML = 'Copied!';

                    setTimeout(function () {
                        button.innerHTML = currentLabel;
                    }, 3000)
                });
            </script>
        @endif
    @endpush
@endif
