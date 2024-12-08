<div class="col-12 col-md-3 pt-5 pt-md-24">
    <h6>Account Payable</h6>
    <div class="ms-8">
        <x-Form.CheckboxInput
            name="permissions[]"
            class="mb-3"
            value="account.payable.view"
            :checked="in_array('account.payable.view', old('permissions', $permissions ?? []))">
            View Account Payable
        </x-Form.CheckboxInput>
    </div>

    <h6>Inventory</h6>
    <div class="ms-5">
        <h6>List Of Product</h6>
        <div class="ms-3 mb-10">
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="inventory.product.view"
                :checked="in_array('inventory.product.view', old('permissions', $permissions ?? []))">
                View Product
            </x-Form.CheckboxInput>
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="inventory.product.create"
                :checked="in_array('inventory.product.create', old('permissions', $permissions ?? []))">
                Create New Product
            </x-Form.CheckboxInput>
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="inventory.product.edit"
                :checked="in_array('inventory.product.edit', old('permissions', $permissions ?? []))">
                Edit Product
            </x-Form.CheckboxInput>
            <x-Form.CheckboxInput
                name="permissions[]"
                class="mb-3"
                value="inventory.product.delete"
                :checked="in_array('inventory.product.delete', old('permissions', $permissions ?? []))">
                Delete Product
            </x-Form.CheckboxInput>
        </div>
    </div>

    <h6>Production</h6>
    <div class="ms-8">
        <x-Form.CheckboxInput
            name="permissions[]"
            class="mb-3"
            value="production.view"
            :checked="in_array('production.view', old('permissions', $permissions ?? []))">
            View Production
        </x-Form.CheckboxInput>
    </div>

    <h6>Delivery</h6>
    <div class="ms-8">
        <x-Form.CheckboxInput
            name="permissions[]"
            class="mb-3"
            value="delivery.view"
            :checked="in_array('delivery.view', old('permissions', $permissions ?? []))">
            View Delivery
        </x-Form.CheckboxInput>
    </div>

    <h6>General Ledger</h6>
    <div class="ms-8">
        <x-Form.CheckboxInput
            name="permissions[]"
            class="mb-3"
            value="general.ledger.view"
            :checked="in_array('general.ledger.view', old('permissions', $permissions ?? []))">
            View General Ledger
        </x-Form.CheckboxInput>
    </div>

    <h6>Management Setting</h6>
    <div class="ms-8">
        <x-Form.CheckboxInput
            name="permissions[]"
            class="mb-3"
            value="management_setting.index"
            :checked="in_array('management_setting.index', old('permissions', $permissions ?? []))">
            View Management Setting
        </x-Form.CheckboxInput>
        <x-Form.CheckboxInput
            name="permissions[]"
            class="mb-3"
            value="management_setting.upsert"
            :checked="in_array('management_setting.upsert', old('permissions', $permissions ?? []))">
            Edit Management Setting
        </x-Form.CheckboxInput>
    </div>
</div>
