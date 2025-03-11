<x-table.general-table :data-table="$customerInvoices">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">ID</th>
        <th style="vertical-align: middle; text-align: left;">Name</th>
        <th style="vertical-align: middle; text-align: left;">Account Name</th>
        <th style="vertical-align: middle; text-align: left;">Tku Customer</th>
        <th style="vertical-align: middle; text-align: left;">NPWP</th>
        <th style="vertical-align: middle; text-align: left;">NPWP Address</th>
        <th style="vertical-align: middle; text-align: left;">Condition</th>
        <th class="text-end min-w-70px">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($customerInvoices as $customerInvoice)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$customerInvoice->id}}</td>
                <td>{{$customerInvoice->name}}</td>
                <td>{{$customerInvoice->account_name}}</td>
                <td>{{$customerInvoice->id_tku_customer}} ({{strlen($customerInvoice->id_tku_customer)}})</td>
                <td>{{$customerInvoice->npwp_customer}} ({{strlen($customerInvoice->npwp_customer)}})</td>
                <td>{{ Str::limit($customerInvoice->npwp_address, 31, '...') }}</td>
                <td style="text-align: center">
                    @if(strlen($customerInvoice->npwp_customer) != 16 || strlen($customerInvoice->id_tku_customer) != 22 || empty($customerInvoice->npwp_address))
                        ❌️
                    @else
                        ✅️
                    @endif
                    <x-modal id="modal_view{{$customerInvoice->id}}"
                             title="Data {{$customerInvoice->account_name}}" size="1000">
                        @include('master_data.customer_invoice.partials.detail_modal',['$customerInvoice' => $customerInvoice])
                    </x-modal>
                </td>

                <x-table.action-button
                    edit-route-name="master-data.customer-invoice.edit"
                    :edit-route="route('master-data.customer-invoice.edit',$customerInvoice->id)"
                    modal-view-i-d="modal_view{{$customerInvoice->id}}"/>
            </tr>
        @endforeach
    @endslot
</x-table.general-table>
