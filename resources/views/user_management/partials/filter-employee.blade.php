<x-table.advance-filter using-apply-button="true">
    <x-form.select-box name="status" :items="StatusEmployee::valuesObject()" label="Employee Status"
                       :default-value="request()->status" placeholder="Select Employee Status..."
                       class="col-12 col-md-3 mb-5"
                       type="row" size-form="sm"/>
    <x-form.select-box-geographic :province-i-d="request()->province_id" form-method="GET" size-form="sm"
                                  class="col-12 col-md-3 mb-5" type="row"/>
</x-table.advance-filter>
