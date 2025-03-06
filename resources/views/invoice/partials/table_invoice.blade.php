<x-table.general-table :data-table="$invoices">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">
            <input type="checkbox" id="selectAllExportInvoice" onclick="toggleSelectAll(this)">
        </th>
        <th style="vertical-align: middle; text-align: left; min-width: 75px; max-width: 75px;">Date Imported</th>
        <th style="vertical-align: middle; text-align: left; min-width: 70px; max-width: 70px;">Time Imported</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Customer Account</th>
        <th style="vertical-align: middle; text-align: left; min-width: 100px; max-width: 100px;">Invoice Date</th>
        <th style="vertical-align: middle; text-align: left; min-width: 110px; max-width: 110px;">Invoice Number</th>
        <th style="vertical-align: middle; text-align: left; min-width: 90px; max-width: 90px;">Grand Total Include
            Tax
        </th>
        <th style="vertical-align: middle; text-align: left; min-width: 94px; max-width: 94px;">Kwitansi Number</th>
        <th style="vertical-align: middle; text-align: left; min-width: 94px; max-width: 94px;">BST Number</th>
        <th style="vertical-align: middle; text-align: left;">Billing Status</th>
        <th class="text-end" style="width: 185px; min-width: 185px; max-width: 185px;">Actions</th>
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
                <td>{{ \Carbon\Carbon::parse($invoice->createdAt())->format('d/m/y') }}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->createdAt())->format('H:i') }}</td>
                <td>{{$invoice->customer->name}}</td>
                <td>{{$invoice->customer->account_name}}</td>
                <td>{{$invoice->date}}</td>
                <td>{{$invoice->number}}</td>
                <td style="text-align: right">{{\App\Utils\Util::rupiah($invoice->calculate($invoice->ppn)["grand_total"],false,true,true)}}</td>
                <td>{{$invoice->receipt_number}}</td>
                <td>{{$invoice->bst_number}}</td>
                <td>
                    @if ($invoice->bst_status === 'close')
                        <span style="color: #007bff; font-weight: bold;">Close</span>
                    @elseif ($invoice->bst_status === 'open')
                        <span style="color: #fd7e14; font-weight: bold;">Open</span>
                    @else
                        <span>{{ $invoice->bst_status }}</span>
                    @endif
                </td>
                <td>
                    <a href="" data-bs-toggle="modal"
                       data-bs-target="#modalDetailInvoice{{$invoice->id}}"
                       class="btn btn-sm edit-td-action-btn mb-2"
                    >
                        <img src="{{asset('assets/images/View.svg')}}" alt="Detail" width="16" height="16">
                    </a>
                    @can('receivable.entry.invoice.export')
                        <a href="" data-bs-toggle="modal"
                           data-bs-target="#modalExportInvoice{{$invoice->id}}"
                           class="btn btn-sm edit-td-action-btn mb-2"
                        >
                            <img src="{{asset('assets/images/Export.svg')}}" alt="Detail" width="16" height="16">
                        </a>
                    @endcan
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
                               class="btn btn-sm edit-td-action-btn mb-2">
                                <img src="{{asset('assets/images/Delete.svg')}}" alt="Detail" width="16" height="16">
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

                    @can('receivable.entry.invoice.export')
                        <x-modal id="modalExportInvoice{{$invoice->id}}"
                                 title="Export {{$invoice->number}}" size="1000">
                            @include('invoice.partials.export_modal',['onlyReceipt' => false,'invoice'=>$invoice])
                        </x-modal>
                    @endcan
                </td>
            </tr>
        @endforeach
    @endslot
</x-table.general-table>

@push('script')
    <script>
        let btnDomID = document.getElementById("receivable.entry.invoice.exportbtn");
        let btnDomIDDeleteSelectBox = document.getElementById("deleted_select_box_btn");
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
                btnDomIDDeleteSelectBox.style.pointerEvents = "auto";
                btnDomIDDeleteSelectBox.style.opacity = "1";
            } else {
                btnDomID.style.pointerEvents = "none";
                btnDomID.style.opacity = "0.5";
                btnDomIDDeleteSelectBox.style.pointerEvents = "none";
                btnDomIDDeleteSelectBox.style.opacity = "0.5";
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
