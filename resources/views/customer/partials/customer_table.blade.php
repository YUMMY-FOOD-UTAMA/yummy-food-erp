<x-table.general-table :data-table="$customers">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Customer Code</th>
{{--        <th style="vertical-align: middle; text-align: left;">Region Name</th>--}}
        <th style="vertical-align: middle; text-align: left;">Area Name</th>
{{--        <th style="vertical-align: middle; text-align: left;">Customer Segment</th>--}}
        <th style="vertical-align: middle; text-align: left;">Customer Category</th>
        <th style="vertical-align: middle; text-align: left;">Customer Name</th>
        <th style="vertical-align: middle; text-align: left;">Contact Person</th>
        <th class="text-end min-w-70px">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($customers as $customer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $customer->code }}</td>
{{--                <td>{{ $customer->area?->region?->name }}</td>--}}
                <td>{{ $customer->area->name }}</td>
{{--                <td>{{ $customer->customerSegment->name }}</td>--}}
                <td>{{ $customer->customerCategory->name }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->contact_person_phone }}</td>
                @if($isTrash)
                    <x-table.action-button restore-route-name="receivable.customer.restore"
                                           restore-route="{{route('receivable.customer.restore',$customer->id)}}"
                                           modal-view-i-d="modal_view{{$customer->id}}"/>
                @else
                    <x-table.action-button
                        edit-route-name="receivable.customer.show"
                        :edit-route="route('receivable.customer.show',$customer->id)"
                        modal-view-i-d="modal_view{{$customer->id}}"
                        soft-delete-route-name="receivable.customer.destroy"
                        soft-delete-route="{{route('receivable.customer.destroy',$customer->id)}}"
                        delete-preview="{{$customer->name ?$customer->name:'Customer'}}"/>
                @endif
            </tr>
            <x-modal id="modal_view{{$customer->id}}"
                     route-view-name="receivable.customer.show"
                     :route-view-data="route('receivable.customer.show',$customer->id)"
                     title="Data {{$customer->name ? $customer->name : 'Customer'}}" size="1000">
                @include('customer.partials.customer_tabs_detail',['customer'=>$customer])
            </x-modal>
        @endforeach
    @endslot
</x-table.general-table>
