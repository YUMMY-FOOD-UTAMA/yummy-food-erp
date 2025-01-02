<div {{$attributes->merge(['class' => ''])}}>
    @if($type == "inline")
        <label class="col-lg-4 col-form-label {{$required ? 'required':''}} fw-semibold fs-6">Customer</label>
        <div class="col-lg-8 fv-row">
            <select name="customer_id" aria-label="Select a Customer" id="customer_id{{$uuid}}"
                    class="form-select form-select-solid form-select-{{$sizeForm}}">
                @if ($customer)
                    <option value="{{ $customer->id }}" selected>
                        {{$customer->user->name}}
                    </option>
                @endif
            </select>
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 {{$required?'required':''}} fw-semibold mb-2">Customer</label>
        <select name="customer_id" aria-label="Select a Customer" id="customer_id{{$uuid}}"
                class="form-select form-select-solid form-select-{{$sizeForm}}">
            @if ($customer)
                <option value="{{ $customer->id }}" selected>
                    {{$customer->name}}
                </option>
            @endif
        </select>
    @endif
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#customer_id{{$uuid}}').select2({
                ajax: {
                    url: "{{route('api.get.customers')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                            page_size: 25,
                            name_is_not_null: "1",
                            with_trashed: "{{$withTrashed}}",
                            only_trashed: "{{$onlyTrashed}}"
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.result.data.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }),
                            pagination: {
                                more: (params.page * 25) < data.result.total // load more data
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                placeholder: 'Select A Customer',
                allowClear: true
            });
        });
    </script>
@endpush
