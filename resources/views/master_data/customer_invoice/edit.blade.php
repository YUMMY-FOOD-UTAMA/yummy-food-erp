@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar heading-name="Customer Invoice">
            </x-toolbar>
        @endslot
        <form method="POST"
              action="{{route('master-data.customer-invoice.update',$customerInvoice->id)}}">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="d-flex flex-column flex-lg-row align-items-start mb-10">
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-flex flex-column me-n7 pe-7">
                                    {{--                    <x-form.input class="fv-row mb-10" :default-value="$employee->user->full_name"--}}
                                    {{--                                  view-only="true"--}}
                                    {{--                                  label="Full Name" name="full_name"/>--}}
                                    <div class="row g-9 mb-8">
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$customerInvoice->name"
                                                      label="Name"
                                                      name="name"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="$customerInvoice->account_name"
                                                      label="Account Name"
                                                      name="account_name"/>
                                        <x-form.input class="col-md-6 fv-row"
                                                      :default-value="$customerInvoice->npwp_customer"
                                                      label="Npwp Customer"
                                                      name="npwp_customer"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="strlen($customerInvoice->npwp_customer)"
                                                      label="Npwp Customer Length"
                                                      name="npwp_customer_length"/>
                                        <x-form.input class="col-md-6 fv-row"
                                                      :default-value="$customerInvoice->id_tku_customer"
                                                      label="ID TKU Customer"
                                                      name="id_tku_customer"/>
                                        <x-form.input class="col-md-6 fv-row" view-only="true"
                                                      :default-value="strlen($customerInvoice->id_tku_customer)"
                                                      label="ID TKU Customer Length"
                                                      name="id_tku_customer_length"/>
                                        <x-form.text-area class="col-md-6 fv-row"
                                                          label="Npwp Address" auto-resize="true" row="4"
                                                          name="npwp_address"
                                                          :default-value="$customerInvoice->npwp_address"
                                                          placeholder="Address..."></x-form.text-area>
                                        <x-form.text-area view-only="true" class="col-md-6 fv-row"
                                                          label="Address" auto-resize="true" row="4"
                                                          name="address" :default-value="$customerInvoice->address"
                                                          placeholder="Address..."></x-form.text-area>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start gap-3 mb-4 ms-4">
                    <a href="{{route('master-data.customer-invoice.index')}}" class="btn btn-danger">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                    </button>
                </div>
            </div>
        </form>
    </x-general-section-content>

@endsection
@push('script')
    <script>
        $(document).ready(function () {
            function updateLength(inputSelector, lengthSelector) {
                $(inputSelector).on('keyup', function () {
                    let length = $(this).val().length;
                    $(lengthSelector).val(length);
                });
            }

            updateLength('input[name="npwp_customer"]', 'input[name="npwp_customer_length"]');
            updateLength('input[name="id_tku_customer"]', 'input[name="id_tku_customer_length"]');
        });

    </script>
@endpush
