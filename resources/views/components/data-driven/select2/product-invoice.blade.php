<div {{$attributes->merge(['class' => ''])}}>
    @if($type == "inline")
        <label class="col-lg-4 col-form-label {{$required ? 'required':''}} fw-semibold fs-6">{{$label}}</label>
        <div class="col-lg-8 fv-row">
            <select name="product_invoice_id" aria-label="Select a {{$label}}" id="product_invoice_id{{$uuid}}"
                    class="form-select form-select-solid form-select-{{$sizeForm}}">
                @if ($productInvoice)
                    <option value="{{ $productInvoice->id }}" selected>
                        {{$productInvoice->number}}
                    </option>
                @endif
            </select>
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 {{$required?'required':''}} fw-semibold mb-2">{{$label}}</label>
        <select name="product_invoice_id" aria-label="Select a {{$label}}" id="product_invoice_id{{$uuid}}"
                class="form-select form-select-solid form-select-{{$sizeForm}}">
            @if ($productInvoice)
                <option value="{{ $productInvoice->id }}" selected>
                    {{$productInvoice->delivery_note}}
                </option>
            @endif
        </select>
    @endif
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#product_invoice_id{{$uuid}}').select2({
                ajax: {
                    url: "{{route('api.get.product-invoices')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                            page_size: 25,
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.result.data.map(function (item) {
                                return {
                                    id: item.id,
                                    text: item.delivery_note
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
                placeholder: 'Select an {{$label}}',
                allowClear: true
            });
        });
    </script>
@endpush
