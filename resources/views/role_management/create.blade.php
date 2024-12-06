@extends('layouts.app')

@section('content')
    <x-general-section-content>
        @slot('slotToolbar')
            <x-toolbar name="Role Management" route-list-name="user-management.role-management.index"
                route-trash-name="user-management.role-management.trash">
            </x-toolbar>
        @endslot
        <div class="card">
            <div class="card-body px-5">
                <form action="{{ route('user-management.role-management.store') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="mb-5">
                            <label for="role_name" class="form-label">Role Name</label>
                            <input type="text" class="form-control form-control-sm" id="role_name" name="role_name"
                                required>
                        </div>
                        <div class="form-check form-check-custom form-check-solid form-check-sm form-check-success text-center flex-column">
                            <label class="form-check-label text-black d-block mb-2 fs-5">Select All</label>
                            <input class="form-check-input" type="checkbox" id="select-all">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-1">
                            <h6>Authority</h6>
                        </div>
                        {{-- User Management --}}
                        <div class="col-12 col-md-3">
                            <h6>Dashboard</h6>
                            <x-Form.CheckboxInput class="mb-10 ms-3" value="dashboard">View Dashboard</x-Form.CheckboxInput>
                            <x-Form.CheckboxInput value="dashboard" id="user-management">
                                <h6 class="mt-2">User Management</h6>
                            </x-Form.CheckboxInput>
                            <div class="ms-13" id="user-management-input">
                                {{-- All Department --}}
                                <div class="mb-5">
                                    <h6>All Department</h6>
                                    <div class="ms-3">
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.employee.index">View
                                            Employee</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.employee.store">Create
                                            New Employee</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.employee.update">Edit Employee</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.employee.destroy">Delete Employee</x-Form.CheckboxInput>
                                    </div>
                                </div>
                                {{-- Sales Department --}}
                                <div class="mb-5">
                                    <h6>Sales Department</h6>
                                    <div class="ms-3">
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.employee.sales.index">View Employee</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.employee.store">Create New Employee</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.employee.update">Edit Employee</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.employee.destroy">Delete Employee</x-Form.CheckboxInput>
                                    </div>
                                </div>
                                {{-- Role Management --}}
                                <div class="mb-5">
                                    <h6>Role Management</h6>
                                    <div class="ms-3">
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.role-management.index">View Role</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.role-management.store">Create New Role</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.role-management.update">Edit Role</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="user-management.role-management.destroy">Delete Role</x-Form.CheckboxInput>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Account Receivable --}}
                        <div class="col-12 col-md-5 pt-5 pt-md-23">
                            <x-Form.CheckboxInput value="dashboard" id="account-receivable">
                                <h6 class="mt-2">Account Receivable</h6>
                            </x-Form.CheckboxInput>
                            <div class="ms-13" id="account-receivable-input">
                                <h6>CRM</h6>
                                {{-- Sales Mapping --}}
                                <div class="ms-5">
                                    <h6>Sales Mapping</h6>
                                    <div class="ms-3 mb-10">
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-mapping.index">View Sales Mapping (View All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-mapping.index">View Sales Mapping (View
                                            Subordinates)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-mapping.index">View Sales Mapping (One
                                            Self)</x-Form.CheckboxInput>
                                    </div>
                                    <div class="ms-3 mb-10">
                                        <x-Form.CheckboxInput class="mb-3">Create Sales Mapping (Create All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3">Create Sales Mapping (Create
                                            Subordinates)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3">Create Sales Mapping (One
                                            Self)</x-Form.CheckboxInput>
                                    </div>
                                    <div class="ms-3 mb-10">
                                        <x-Form.CheckboxInput class="mb-3">Edit Sales Mapping (Edit All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3">Edit Sales Mapping (Edit
                                            Subordinates)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3">Edit Sales Mapping (One
                                            Self)</x-Form.CheckboxInput>
                                    </div>
                                    <div class="ms-3 mb-5">
                                        <x-Form.CheckboxInput class="mb-3">Delete Sales Mapping (Delete All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3">Delete Sales Mapping (Delete
                                            Subordinates)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3">Delete Sales Mapping (One
                                            Self)</x-Form.CheckboxInput>
                                    </div>
                                </div>
                                {{-- Sales Approval --}}
                                <div class="ms-5">
                                    <h6>Sales Approval</h6>
                                    <div class="ms-3 mb-10">
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-approval.index">View Sales Approval (View All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-approval.index">View Sales Approval (View
                                            Subordinates)</x-Form.CheckboxInput>
                                    </div>
                                    <div class="ms-3 mb-10">
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-approval.approval">Approve & Reject Sales (All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-approval.approval">Approve & Reject Sales
                                            (Subordinates)</x-Form.CheckboxInput>
                                    </div>
                                </div>
                                {{-- Sales Confirm Visit --}}
                                <div class="ms-5">
                                    <h6>Sales Confirm Visit</h6>
                                    <div class="ms-3 mb-10">
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-confirm-visit.index">View Visit (View All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-confirm-visit.index">View Visit (View
                                            Subordinates)</x-Form.CheckboxInput>
                                    </div>
                                    <div class="ms-3 mb-10">
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-confirm-visit.confirm">Confirm Visit (Confirm All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-confirm-visit.confirm">Confirm Visit (Confirm
                                            Subordinates)</x-Form.CheckboxInput>
                                    </div>
                                </div>
                                {{-- Sales Visit Report --}}
                                <div class="ms-5">
                                    <h6>Sales Visit Report</h6>
                                    <div class="ms-3 mb-10">
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-visit-report.index">View Visit Report (View All
                                            Position)</x-Form.CheckboxInput>
                                        <x-Form.CheckboxInput class="mb-3" value="receivable.crm.sales-visit-report.index">View Visit Report (View
                                            Subordinates)</x-Form.CheckboxInput>
                                    </div>
                                </div>
                                {{-- List Of Customer --}}
                                <h6>List Of Customer</h6>
                                <div class="ms-3">
                                    <x-Form.CheckboxInput class="mb-3" value="receivable.customer.index">View Customer</x-Form.CheckboxInput>
                                    <x-Form.CheckboxInput class="mb-3" value="receivable.customer.store">Create New Customer</x-Form.CheckboxInput>
                                    <x-Form.CheckboxInput class="mb-3" value="receivable.customer.update">Edit Customer</x-Form.CheckboxInput>
                                    <x-Form.CheckboxInput class="mb-3" value="receivable.customer.destroy">Delete Customer</x-Form.CheckboxInput>
                                </div>
                            </div>
                        </div>
                        {{-- Account Payable --}}
                        <div class="col-12 col-md-3 pt-5 pt-md-24">
                            <h6>Account Payable</h6>
                            <div class="ms-8">
                                <x-Form.CheckboxInput class="mb-3">......</x-Form.CheckboxInput>
                            </div>
                            <h6>Inventory</h6>
                            <div class="ms-5">
                                <h6>List Of Product</h6>
                                <div class="ms-3 mb-10">
                                    <x-Form.CheckboxInput class="mb-3">View Product</x-Form.CheckboxInput>
                                    <x-Form.CheckboxInput class="mb-3">Create New Product</x-Form.CheckboxInput>
                                    <x-Form.CheckboxInput class="mb-3">Edit Product</x-Form.CheckboxInput>
                                    <x-Form.CheckboxInput class="mb-3">Delete Product</x-Form.CheckboxInput>
                                </div>
                            </div>
                            <h6>Production</h6>
                            <div class="ms-8">
                                <x-Form.CheckboxInput class="mb-3">......</x-Form.CheckboxInput>
                            </div>
                            <h6>Delivery</h6>
                            <div class="ms-8">
                                <x-Form.CheckboxInput class="mb-3">......</x-Form.CheckboxInput>
                            </div>
                            <h6>General Ledger</h6>
                            <div class="ms-8">
                                <x-Form.CheckboxInput class="mb-3">......</x-Form.CheckboxInput>
                            </div>
                            <h6>Management Setting</h6>
                            <div class="ms-8">
                                <x-Form.CheckboxInput class="mb-3" value="management_setting.index">View Management Setting</x-Form.CheckboxInput>
                                <x-Form.CheckboxInput class="mb-3" value="management_setting.upsert">Edit Management Setting</x-Form.CheckboxInput>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-general-section-content>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#user-management').on('change', e => {
                    const isChecked = e.target.checked;

                    $('#user-management-input input[type="checkbox"]').each(function() {
                        this.checked = isChecked;
                    });
                });

                $('#account-receivable').on('change', e => {
                    const isChecked = e.target.checked;

                    $('#account-receivable-input input[type="checkbox"]').each(function() {
                        this.checked = isChecked;
                    });
                });

                $('#select-all').on('change', e => {
                    const isChecked = e.target.checked;

                    $('input[type="checkbox"]').each(function() {
                        this.checked = isChecked;
                    });
                });
            });
        </script>
    @endpush
@endsection
