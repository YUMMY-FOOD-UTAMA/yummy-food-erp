<div {{$attributes->merge(['class' => ''])}}>
    @if($type == "inline")
        <label class="col-lg-4 col-form-label {{$required ? 'required':''}} fw-semibold fs-6">{{$label}}</label>
        <div class="col-lg-8 fv-row">
            <select name="customer_invoice_id" aria-label="Select a {{$label}}" id="customer_invoice_id{{$uuid}}"
                    class="form-select form-select-solid form-select-{{$sizeForm}}">
                @if ($customerInvoice)
                    <option value="{{ $customerInvoice->id }}" selected>
                        {{$accountName ? $customerInvoice->account_name : $customerInvoice->name}}
                    </option>
                @endif
            </select>
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 {{$required?'required':''}} fw-semibold mb-2">{{$label}}</label>
        <select name="customer_invoice_id" aria-label="Select a {{$label}}" id="customer_invoice_id{{$uuid}}"
                class="form-select form-select-solid form-select-{{$sizeForm}}">
            @if ($customerInvoice)
                <option value="{{ $customerInvoice->id }}" selected>
                    {{$accountName ? $customerInvoice->account_name : $customerInvoice->name}}
                </option>
            @endif
        </select>
    @endif
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#customer_invoice_id{{$uuid}}').select2({
                ajax: {
                    url: "{{route('api.get.customer-invoices')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                            page_size: 25,
                            only_available_invoice: true,
                            with_trashed: "{{$withTrashed}}",
                            only_trashed: "{{$onlyTrashed}}"
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.result.data.map(function (item) {
                                @if($accountName)
                                    return {
                                    id: item.id,
                                    text: item.account_name
                                };
                                @else
                                    return {
                                    id: item.id,
                                    text: item.name
                                };
                                @endif

                            }),
                            pagination: {
                                more: (params.page * 25) < data.result.total // load more data
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 0,
                placeholder: 'Select an {{$label}}',
                allowClear: true
            });
        });
    </script>
@endpush
