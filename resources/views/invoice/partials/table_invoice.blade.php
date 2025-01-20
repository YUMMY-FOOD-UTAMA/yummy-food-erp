<x-table.general-table :data-table="$invoices">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Customer Account</th>
        <th style="vertical-align: middle; text-align: left;">Invoice Number</th>
        <th style="vertical-align: middle; text-align: left;">Grand Total Include Tax</th>
        <th style="vertical-align: middle; text-align: left;">Kwitansi Number</th>
        <th style="vertical-align: middle; text-align: left;">Billing</th>
        <th class="text-end" style="width: 200px; min-width: 70px; max-width: 200px;">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($invoices as $invoice)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$invoice->customer->name}}</td>
                <td>{{$invoice->customer->account_name}}</td>
                <td>{{$invoice->number}}</td>
                <td>@rupiah($invoice->calculate()["grand_total"])</td>
                <td>{{$invoice->receipt_number}}</td>
                <td>{{$invoice->status}}</td>
                <td>
                    <a href="" data-bs-toggle="modal"
                       data-bs-target="#modalDetailInvoice{{$invoice->id}}"
                       class="btn btn-primary btn-sm mx-1 edit-td-action-btn mb-2">
                        Detail
                    </a>
                    <a href="" data-bs-toggle="modal"
                       data-bs-target="#modalExportInvoice{{$invoice->id}}"
                       class="btn btn-success btn-sm mx-1 edit-td-action-btn mb-2">
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
                            <form action="{{route('receivable.entry.invoice.delete',$invoice->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <a onclick="event.preventDefault();this.closest('form').submit();"
                                   class="btn btn-danger btn-sm mx-1 edit-td-action-btn mb-2">
                                    Soft Delete
                                </a>
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

