<div class="row p-3">
    <!-- Kolom 1: Semua Filter -->
    <div class="col-12 {{ $usingApplyButton ? 'col-md-10' : '' }} mb-3">
        <div class="row">
            <!-- Filter 1 -->
            <div class="col-12 col-md-3 mb-3">
                <label class="form-label">Sales Name</label>
                <select class="form-select form-select-sm form-select-solid" data-control="select2"
                    data-placeholder="Select Sales Name">
                    <option></option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>

            <!-- Filter 2 -->
            <div class="col-12 col-md-3 mb-3">
                <label class="form-label">Customer Name</label>
                <select class="form-select form-select-sm form-select-solid" data-control="select2"
                    data-placeholder="Select Customer Name">
                    <option></option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>

            <!-- Filter 3 -->
            <div class="col-12 col-md-3 mb-3">
                <label class="form-label">Customer Status</label>
                <select class="form-select form-select-sm form-select-solid" data-control="select2"
                    data-placeholder="Select Customer Status">
                    <option></option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>

            <!-- Filter 4 -->
            <div class="col-12 col-md-3 mb-3">
                <label class="form-label">Visit Status</label>
                <select class="form-select form-select-sm form-select-solid" data-control="select2"
                    data-placeholder="Select Sales Mapping">
                    <option></option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                </select>
            </div>
            <div class="col-12 col-md-3 mb-3">
                <label class="form-label">Visit Range Date</label>
                <input class="form-control form-control-solid" placeholder="Pick date rage" id="kt_daterangepicker_1"/>
            </div>
        </div>
    </div>

    <!-- Kolom 2: Apply Button -->
    @if ($usingApplyButton)
        <div class="col-12 col-md-2 mt-0 mt-md-8">
            <button type="button" class="btn btn-primary btn-sm w-100">Apply</button>
        </div>
    @endif
</div>
