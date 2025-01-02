<x-table.general-table :data-table="$products">
    @slot('slotTheadTh')
        <th style="width: 20px; vertical-align: middle; text-align: left;">No</th>
        <th style="vertical-align: middle; text-align: left;">Item Code</th>
        <th style="vertical-align: middle; text-align: left;">Item Name</th>
        <th style="vertical-align: middle; text-align: left;">Item Category</th>
        <th style="vertical-align: middle; text-align: left;">Item Packing Size</th>
        <th style="vertical-align: middle; text-align: left;">Item Type</th>
        <th class="text-end min-w-70px">Actions</th>
    @endslot
    @slot('slotTbodyTr')
        @foreach($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$product->code}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->category->value}}</td>
                <td>{{$product->packingSize?->value}}</td>
                <td>{{$product->type->value}}</td>
                @if($isTrash)
                    <x-table.action-button restore-route-name="inventory.product.restore"
                                           restore-route="{{route('inventory.product.restore',$product->id)}}"
                                           modal-view-i-d="modal_view{{$product->id}}"/>
                @else
                    <x-table.action-button
                        edit-route-name="inventory.product.show"
                        :edit-route="route('inventory.product.show',$product->id)"
                        modal-view-i-d="modal_view{{$product->id}}"
                        soft-delete-route-name="inventory.product.destroy"
                        soft-delete-route="{{route('inventory.product.destroy',$product->id)}}"
                        delete-preview="{{$product->name ?$product->name:'Product'}}"/>
                @endif
            </tr>
            <x-modal id="modal_view{{$product->id}}"
                     route-view-name="inventory.product.update"
                     :route-view-data="route('inventory.product.show',$product->id)"
                     title="Data {{$product->name ? $product->name : 'Product'}}" size="1000">
                @include('inventory.product.partials.product_form_detail',['product'=>$product,'viewOnly'=>true])
            </x-modal>
        @endforeach
    @endslot
</x-table.general-table>
