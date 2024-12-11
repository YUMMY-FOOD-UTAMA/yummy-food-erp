@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Product"
                       heading-name="Edit Data {{$product->name != null ? $product->name :'Product'}}"
                       route-create-name="inventory.product.store" using-create-modal="true"
                       route-trash-name="inventory.product.trash" route-list-name="inventory.product.index">
                @include('inventory.product.partials.create_product_modal')
            </x-toolbar>
        @endslot
        <div class="card">
            <div class="card-body">
                <form action="{{route('inventory.product.update',$product->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('inventory.product.partials.product_form_detail',[
                        'product'=>$product,'viewOnly'=>false
                    ])

                    <div class="d-flex gap-3">
                        <a href="{{route('inventory.product.index')}}" class="btn btn-danger">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Update</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-general-section-content>
@endsection
