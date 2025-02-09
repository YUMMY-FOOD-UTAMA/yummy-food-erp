<x-table.general-table :data-table="$invoices">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">
            <input type="checkbox" id="selectAllExportInvoice" onclick="toggleSelectAll(this)">
        </th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Customer Account</th>
        <th style="vertical-align: middle; text-align: left;">Invoice Date</th>
        <th style="vertical-align: middle; text-align: left;">Invoice Number</th>
        <th style="vertical-align: middle; text-align: left;">Grand Total Include Tax</th>
        <th style="vertical-align: middle; text-align: left;">Kwitansi Number</th>
        <th style="vertical-align: middle; text-align: left;">Billing</th>
        <th class="text-end" style="width: 250px; min-width: 70px; max-width: 250px;">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($invoices as $invoice)
            <tr>
                {{--                @if(request()->get('customer_invoice_id'))--}}
                <td>
                    <input type="checkbox" class="select-item-invoice"
                           value="{{ $invoice->id }}">
                </td>
                {{--                @endif--}}
                <td>{{$invoice->customer->name}}</td>
                <td>{{$invoice->customer->account_name}}</td>
                <td>{{$invoice->date}}</td>
                <td>{{$invoice->number}}</td>
                <td>{{\App\Utils\Util::rupiah($invoice->calculate()["grand_total"])}}</td>
                <td>{{$invoice->receipt_number}}</td>
                <td>{{$invoice->status}}</td>
                <td>
                    <a href="" data-bs-toggle="modal"
                       data-bs-target="#modalDetailInvoice{{$invoice->id}}"
                       class="btn btn-primary btn-sm mx-1 edit-td-action-btn mb-2"
                    >
                        Detail
                    </a>
                    <a href="" data-bs-toggle="modal"
                       data-bs-target="#modalExportInvoice{{$invoice->id}}"
                       class="btn btn-success btn-sm mx-1 edit-td-action-btn mb-2"
                    >
                        Export
                    </a>
                    @if($isTrash)
                        @can('receivable.entry.invoice.restore')
                            <form action="{{route('receivable.entry.invoice.restore',$invoice->id)}}" method="POST">
                                @method('POST')
                                @csrf
                                <a onclick="event.preventDefault();this.closest('form').submit();"
                                   class="btn btn-info btn-sm mx-1 edit-td-action-btn mb-2">
                                    Restore
                                </a>
                            </form>
                        @endcan
                    @else
                        @can('receivable.entry.invoice.delete')
                            <a href="#" onclick="submitDeleteForm(event, 'deleteform_{{$invoice->id}}')"
                               class="btn btn-danger btn-sm mx-1 edit-td-action-btn mb-2">
                                Delete
                            </a>
                            <form action="{{route('receivable.entry.invoice.delete',$invoice->id)}}"
                                  id="deleteform_{{$invoice->id}}" method="POST">
                                @method('DELETE')
                                @csrf

                            </form>
                        @endcan
                    @endif
                    <x-modal id="modalDetailInvoice{{$invoice->id}}"
                             title="Data {{$invoice->number}}" size="1000">
                        @include('invoice.partials.invoice_detail',['invoice' => $invoice])
                    </x-modal>
                    <x-modal id="modalExportInvoice{{$invoice->id}}"
                             title="Export {{$invoice->number}}" size="1000">
                        @include('invoice.partials.export_modal',['onlyReceipt' => false,'invoice'=>$invoice])
                    </x-modal>
                </td>
            </tr>
        @endforeach
    @endslot
</x-table.general-table>

@push('script')
    <script>
        let btnDomID = document.getElementById("receivable.entry.invoice.exportbtn");
        let selectItems = document.querySelectorAll(".select-item-invoice");

        function updateButtonVisibility() {
            let checkedItems = document.querySelectorAll(".select-item-invoice:checked");

            const urlParams = new URLSearchParams(window.location.search);

            // if (!urlParams.has('customer_invoice_id') || urlParams.get('customer_invoice_id').trim() === '') {
            //     alert('Silakan lakukan filter berdasarkan nama customer atau account name customer.');
            //     checkedItems.forEach((item) => {
            //         item.checked = false;
            //     });
            //     return
            // }

            if (checkedItems.length > 0) {
                btnDomID.style.pointerEvents = "auto";
                btnDomID.style.opacity = "1";
            } else {
                btnDomID.style.pointerEvents = "none";
                btnDomID.style.opacity = "0.5";
            }
        }

        selectItems.forEach((item) => {
            item.addEventListener("change", updateButtonVisibility);
        });

        function toggleSelectAll(checkbox) {
            const urlParams = new URLSearchParams(window.location.search);
            // if (!urlParams.has('customer_invoice_id') || urlParams.get('customer_invoice_id').trim() === '') {
            //     checkbox.checked = false
            //     alert('Silakan lakukan filter berdasarkan nama customer atau account name customer.');
            //     return
            // }
            const checkboxes = document.querySelectorAll('.select-item-invoice');
            checkboxes.forEach(cb => {
                if (!cb.disabled) {
                    cb.checked = checkbox.checked;
                }
            });
            updateButtonVisibility()
        }

        function submitDeleteForm(event, formId) {
            event.preventDefault();
            var form = document.getElementById(formId);
            if (form) {
                form.submit();
            } else {
                console.error("Form dengan ID " + formId + " tidak ditemukan.");
            }
        }
    </script>
@endpush
