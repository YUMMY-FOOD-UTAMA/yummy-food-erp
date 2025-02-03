<x-card id="invoice_detail" title="Invoice Data">
    <div class="row g-9 mb-8">
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->number"
                      label="Invoice Number" view-only="true"
                      name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->date"
                      label="Invoice Date" view-only="true"
                      name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->receipt_number"
                      label="Receipt Number" view-only="true"
                      name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->status"
                      label="Receipt Status" view-only="true"
                      name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->term_of_payment"
                      label="Term Of Payment" view-only="true"
                      name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->term_of_delivery"
                      label="Term Of Delivery" view-only="true"
                      name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->supplier_name"
                      label="Supplier Name" view-only="true"
                      name="name"/>
        <x-form.text-area class="col-md-6 fv-row"
                          view-only="true"
                          :default-value="strip_tags($invoice->supplier_address)"
                          label="Supplier Address" view-only="true"
                          name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->customer->name"
                      label="Customer Name" view-only="true"
                      name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="$invoice->customer->account_name"
                      label="Customer Account Name" view-only="true"
                      name="name"/>
    </div>
    <x-form.text-area class="fv-row mb-10"
                      view-only="true"
                      :default-value="strip_tags($invoice->customer->address)"
                      label="Customer Address" view-only="true"
                      name="name"/>
    <div class="row g-9 mb-8">
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="Util::rupiah($invoice->product_total_amount)"
                      label="Product Total Amount" view-only="true"
                      name="name"/>
        <x-form.input class="col-md-6 fv-row"
                      view-only="true"
                      :default-value="Util::rupiah($invoice->product_total_discount)"
                      label="Product Total Discount" view-only="true"
                      name="name"/>
    </div>
</x-card>

<x-card id="invoice_detail_products" title="Product Data">
    <x-table.general-table :data-table="$invoice->products">
        @slot('slotTheadTh')
            <th style="vertical-align: middle; text-align: left; width: 150px; max-width: 150px">Name</th>
            <th style="vertical-align: middle; text-align: left;">Delivery Note</th>
            <th style="vertical-align: middle; text-align: left;">Delivery Note Date</th>
            <th style="vertical-align: middle; text-align: left;">Qty</th>
            <th style="vertical-align: middle; text-align: left;">Rate</th>
            <th style="vertical-align: middle; text-align: left;">Discount</th>
            <th style="vertical-align: middle; text-align: left;">Net Rate</th>
        @endslot
        @slot('slotTbodyTr')
            @foreach($invoice->products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->delivery_note}}</td>
                    <td>{{$product->delivery_note_date}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>{{\App\Utils\Util::rupiah($product->rate)}}</td>
                    <td>@percentage($product->discount)</td>
                    <td>{{\App\Utils\Util::rupiah($product->net_rate)}}</td>
                </tr>
            @endforeach
        @endslot
    </x-table.general-table>
</x-card>

