@extends('layouts.app')
@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Product" route-create-name="inventory.product.store" using-create-modal="true"
                       route-list-name="inventory.product.index">
                @include('inventory.product.partials.create_product_modal')
            </x-toolbar>
        @endslot
        <div class="card">
            @include('inventory.product.partials.product_filter')
            <x-table.basic-filter-and-export name="Product"/>

            @include('inventory.product.partials.product_table',['isTrash'=>true])
        </div>
        <div class="d-flex p-5 justify-content-end">
            {!! $products->links() !!}
        </div>
    </x-general-section-content>
@endsection