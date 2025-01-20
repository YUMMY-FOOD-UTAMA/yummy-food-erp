<div {{$attributes->merge(['class' => ''])}}>
    @if($type == "inline")
        <label class="col-lg-4 col-form-label {{$required ? 'required':''}} fw-semibold fs-6">{{$label}}</label>
        <div class="col-lg-8 fv-row">
            <select name="invoice_id" aria-label="Select a {{$label}}" id="invoice_id{{$uuid}}"
                    class="form-select form-select-solid form-select-{{$sizeForm}}">
                @if ($invoice)
                    <option value="{{ $invoice->id }}" selected>
                        {{$invoice->number}}
                    </option>
                @endif
            </select>
        </div>
    @elseif($type=="row")
        <label class="d-flex align-items-center fs-6 {{$required?'required':''}} fw-semibold mb-2">{{$label}}</label>
        <select name="invoice_id" aria-label="Select a {{$label}}" id="invoice_id{{$uuid}}"
                class="form-select form-select-solid form-select-{{$sizeForm}}">
            @if ($invoice)
                <option value="{{ $invoice->id }}" selected>
                    {{$invoice->number}}
                </option>
            @endif
        </select>
    @endif
</div>

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#invoice_id{{$uuid}}').select2({
                ajax: {
                    url: "{{route('api.get.invoices')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1,
                            page_size: 25,
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
                                    text: item.number
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
