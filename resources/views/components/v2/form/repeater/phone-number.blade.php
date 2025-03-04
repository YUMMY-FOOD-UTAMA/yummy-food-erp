@props([
    'id'=>'phone_numbers',
    'dataRepeaterList'=>'phone_numbers',
    'dataKtRepeater'=>'phone_number_masking',
    'name'=>'phone_number'
])
<div class="row g-9 mb-8">
    <div id="{{$id}}">
        <div class="form-group">
            <div data-repeater-list="{{$dataRepeaterList}}">
                <div data-repeater-item>
                    <label
                        class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="">Phone Number</span>
                    </label>
                    <div class="d-flex w-100 align-items-center">
                        <input type="text"
                               data-kt-repeater="{{$dataKtRepeater}}"
                               name="{{$name}}"
                               class="form-control form-control-solid form-control-lg"/>
                        <a href="javascript:;" data-repeater-delete
                           class="btn btn-light-danger ms-2">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group mt-5">
            <a href="javascript:;" data-repeater-create
               class="btn btn-light-primary">
                Add
            </a>
        </div>
    </div>
</div>
@push('script')
    <script>
        var repeaterPhoneNumbers = $('#{{$id}}').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'Default Outer',
            },

            show: function () {
                $(this).slideDown();

                new Inputmask({
                    mask: "(+62) [9]{0,20}",
                    placeholder: "(+62) xxxxxxxx",
                    definitions: {
                        '9': {
                            validator: "[0-9]",
                        }
                    },
                    greedy: false
                }).mask(this.querySelector('[data-kt-repeater="{{$dataKtRepeater}}"]'));
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function () {
                new Inputmask({
                    mask: "(+62) [9]{0,20}",
                    placeholder: "(+62) xxxxxxxx",
                    definitions: {
                        '9': {
                            validator: "[0-9]",
                        }
                    },
                    greedy: false
                }).mask(document.querySelector('[data-kt-repeater="{{$dataKtRepeater}}"]'));
            }
        });
    </script>
@endpush
