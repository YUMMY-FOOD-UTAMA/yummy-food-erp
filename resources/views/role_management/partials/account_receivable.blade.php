<div class="col-12 col-md-5 pt-5 pt-md-23">
    <x-Form.CheckboxInput name="permissions[]" value="dashboard" id="account-receivable">
        <h6 class="mt-2">Account Receivable</h6>
    </x-Form.CheckboxInput>
    <div class="ms-13" id="account-receivable-input">
        <h6>CRM</h6>
        {{-- Sales Mapping --}}
        <div class="ms-5">
            <h6>Sales Mapping
                <i class="fas fa-exclamation-circle ms-2 fs-7"
                   data-bs-toggle="tooltip"
                   title="This is not yet valid because it is still in the development stage">
                </i>
            </h6>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.index"
                                      :checked="in_array('receivable.crm.sales-mapping.index', old('permissions', $permissions ?? []))">
                    View Sales Mapping (View All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.subordinates"
                                      :checked="in_array('receivable.crm.sales-mapping.subordinates', old('permissions', $permissions ?? []))">
                    View Sales Mapping (View Subordinates)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.self"
                                      :checked="in_array('receivable.crm.sales-mapping.self', old('permissions', $permissions ?? []))">
                    View Sales Mapping (One Self)
                </x-Form.CheckboxInput>
            </div>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.create-all"
                                      :checked="in_array('receivable.crm.sales-mapping.create-all', old('permissions', $permissions ?? []))">
                    Create Sales Mapping (Create All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.create-subordinates"
                                      :checked="in_array('receivable.crm.sales-mapping.create-subordinates', old('permissions', $permissions ?? []))">
                    Create Sales Mapping (Create Subordinates)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.create-self"
                                      :checked="in_array('receivable.crm.sales-mapping.create-self', old('permissions', $permissions ?? []))">
                    Create Sales Mapping (One Self)
                </x-Form.CheckboxInput>
            </div>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.edit-all"
                                      :checked="in_array('receivable.crm.sales-mapping.edit-all', old('permissions', $permissions ?? []))">
                    Edit Sales Mapping (Edit All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.edit-subordinates"
                                      :checked="in_array('receivable.crm.sales-mapping.edit-subordinates', old('permissions', $permissions ?? []))">
                    Edit Sales Mapping (Edit Subordinates)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.edit-self"
                                      :checked="in_array('receivable.crm.sales-mapping.edit-self', old('permissions', $permissions ?? []))">
                    Edit Sales Mapping (One Self)
                </x-Form.CheckboxInput>
            </div>
            <div class="ms-3 mb-5">
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.delete-all"
                                      :checked="in_array('receivable.crm.sales-mapping.delete-all', old('permissions', $permissions ?? []))">
                    Delete Sales Mapping (Delete All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.delete-subordinates"
                                      :checked="in_array('receivable.crm.sales-mapping.delete-subordinates', old('permissions', $permissions ?? []))">
                    Delete Sales Mapping (Delete Subordinates)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.crm.sales-mapping.delete-self"
                                      :checked="in_array('receivable.crm.sales-mapping.delete-self', old('permissions', $permissions ?? []))">
                    Delete Sales Mapping (One Self)
                </x-Form.CheckboxInput>
            </div>
        </div>
        {{-- Sales Schedule Visit --}}
        <div class="ms-5">
            <h6>Sales Schedule Visit
                <i class="fas fa-exclamation-circle ms-2 fs-7"
                   data-bs-toggle="tooltip"
                   title="If you check only-self then view all positions will not be valid">
                </i>
            </h6>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.schedule-visit.index"
                    :checked="in_array('receivable.crm.schedule-visit.index', old('permissions', $permissions ?? []))">
                    View Sales Schedule Visit (View All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.schedule-visit.index.only-self"
                    :checked="in_array('receivable.crm.schedule-visit.index.only-self', old('permissions', $permissions ?? []))">
                    View Sales Schedule Visit (View only-self)
                </x-Form.CheckboxInput>
            </div>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.schedule-visit.create,receivable.crm.schedule-visit.store"
                    :checked="in_array('receivable.crm.schedule-visit.create,receivable.crm.schedule-visit.store', old('permissions', $permissions ?? []))
                            || in_array('receivable.crm.schedule-visit.create', old('permissions', $permissions ?? []))"
                >
                    Create Sales Schedule Visit
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.schedule-visit.cancel"
                    :checked="in_array('receivable.crm.schedule-visit.cancel', old('permissions', $permissions ?? []))">
                    Cancel Schedule Visit
                </x-Form.CheckboxInput>
            </div>
        </div>
        {{-- Sales Approval --}}
        <div class="ms-5">
            <h6>Sales Approval</h6>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-approval.index"
                    :checked="in_array('receivable.crm.sales-approval.index', old('permissions', $permissions ?? []))">
                    View Sales Approval (View All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-approval.index"
                    :checked="in_array('receivable.crm.sales-approval.index', old('permissions', $permissions ?? []))">
                    View Sales Approval (View Subordinates)
                </x-Form.CheckboxInput>
            </div>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-approval.approval"
                    :checked="in_array('receivable.crm.sales-approval.approval', old('permissions', $permissions ?? []))">
                    Approve & Reject Sales (All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-approval.approval"
                    :checked="in_array('receivable.crm.sales-approval.approval', old('permissions', $permissions ?? []))">
                    Approve & Reject Sales (Subordinates)
                </x-Form.CheckboxInput>
            </div>
        </div>
        {{-- Sales Confirm Visit --}}
        <div class="ms-5">
            <h6>Sales Confirm Visit
                <i class="fas fa-exclamation-circle ms-2 fs-7"
                   data-bs-toggle="tooltip"
                   title="If you check only-self then view/confirm all positions will not be valid">
                </i>
            </h6>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-confirm-visit.index"
                    :checked="in_array('receivable.crm.sales-confirm-visit.index', old('permissions', $permissions ?? []))">
                    View Visit (View All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-confirm-visit.index.only-self"
                    :checked="in_array('receivable.crm.sales-confirm-visit.index.only-self', old('permissions', $permissions ?? []))">
                    View Visit (View Only-Self)
                </x-Form.CheckboxInput>
            </div>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-confirm-visit.confirm"
                    :checked="in_array('receivable.crm.sales-confirm-visit.confirm', old('permissions', $permissions ?? []))">
                    Confirm Visit (Confirm All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-confirm-visit.confirm.only-self"
                    :checked="in_array('receivable.crm.sales-confirm-visit.confirm.only-self', old('permissions', $permissions ?? []))">
                    Confirm Visit (Confirm Only-Self)
                </x-Form.CheckboxInput>
            </div>
        </div>
        {{-- Sales Visit Report --}}
        <div class="ms-5">
            <h6>Sales Visit Report
                <i class="fas fa-exclamation-circle ms-2 fs-7"
                   data-bs-toggle="tooltip"
                   title="If you check only-self then view all positions will not be valid">
                </i>
            </h6>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-visit-report.index"
                    :checked="in_array('receivable.crm.sales-visit-report.index', old('permissions', $permissions ?? []))">
                    View Visit Report (View All Position)
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput
                    name="permissions[]"
                    class="mb-3"
                    value="receivable.crm.sales-visit-report.index.only-self"
                    :checked="in_array('receivable.crm.sales-visit-report.index.only-self', old('permissions', $permissions ?? []))">
                    View Visit Report (View Only-Self)
                </x-Form.CheckboxInput>
            </div>
        </div>

        {{-- List Of Customer --}}
        <h6>List Of Customer</h6>
        <div class="ms-3">
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="receivable.customer.index"
                :checked="in_array('receivable.customer.index', old('permissions', $permissions ?? []))">
                View Customer
            </x-Form.CheckboxInput>
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value='receivable.customer.store'
                :checked="in_array('receivable.customer.store', old('permissions', $permissions ?? []))">
                Create New Customer
            </x-Form.CheckboxInput>
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="receivable.customer.update,receivable.customer.show"
                :checked="in_array('receivable.customer.update,receivable.customer.show', old('permissions', $permissions ?? []))
                    || in_array('receivable.customer.update', old('permissions', $permissions ?? []))">
                Edit Customer
            </x-Form.CheckboxInput>
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="receivable.customer.destroy"
                :checked="in_array('receivable.customer.destroy', old('permissions', $permissions ?? []))">
                Delete Customer
            </x-Form.CheckboxInput>
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="receivable.customer.trash"
                :checked="in_array('receivable.customer.trash', old('permissions', $permissions ?? []))">
                View Trash Customer
            </x-Form.CheckboxInput>
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="receivable.customer.restore"
                :checked="in_array('receivable.customer.restore', old('permissions', $permissions ?? []))">
                Restore Customer
            </x-Form.CheckboxInput>
        </div>

        <h6>Receivable Entry</h6>
        {{-- Invoice --}}
        <div class="ms-5">
            <h6>Invoice
            </h6>
            <div class="ms-3 mb-10">
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.entry.invoice.index"
                                      :checked="in_array('receivable.entry.invoice.index', old('permissions', $permissions ?? []))">
                    View Invoice
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.entry.invoice.imports"
                                      :checked="in_array('receivable.entry.invoice.imports', old('permissions', $permissions ?? []))">
                    Import Invoice
                </x-Form.CheckboxInput>
                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.entry.invoice.export"
                                      :checked="in_array('receivable.entry.invoice.export', old('permissions', $permissions ?? []))">
                    Export Invoice
                </x-Form.CheckboxInput>

                <x-Form.CheckboxInput name="permissions[]" class="mb-3"
                                      value="receivable.entry.invoice.delete,receivable.entry.invoice.deletes"
                                      :checked="in_array('receivable.entry.invoice.delete,receivable.entry.invoice.deletes', old('permissions', $permissions ?? []))">
                    Delete Invoice
                </x-Form.CheckboxInput>
            </div>
        </div>
    </div>
</div>
