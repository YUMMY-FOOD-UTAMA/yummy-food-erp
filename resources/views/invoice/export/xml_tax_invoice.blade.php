<?xml version = "1.0" encoding = "utf-8" ?>
<TaxInvoiceBulk xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <TIN>0013470778007000</TIN>
    <ListOfTaxInvoice>
        @foreach($invoices as $invoice)
            <TaxInvoice>
                @php
                    $date = Illuminate\Support\Carbon::createFromFormat('j-M-Y', $invoice->date)->format("Y-m-d");
                @endphp
                <TaxInvoiceDate>{!! $date !!}</TaxInvoiceDate>
                <TaxInvoiceOpt>Normal</TaxInvoiceOpt>
                <TrxCode>{{$request->get('code_transaction')}}</TrxCode>
                @if($request->get('additional_information'))
                    <AddInfo> {{$request->get('additional_information')}} </AddInfo>
                @else
                    <AddInfo/>
                @endif

                @if($request->get('supporting_document'))
                    <CustomDoc> {{$request->get('supporting_document')}} </CustomDoc>
                @else
                    <CustomDoc/>
                @endif

                <RefDesc>{{$invoice->number}}</RefDesc>

                @if($request->get('facility_stamp'))
                    <FacilityStamp> {{$request->get('facility_stamp')}} </FacilityStamp>
                @else
                    <FacilityStamp/>
                @endif

                <SellerIDTKU>0013470778007000000000</SellerIDTKU>
                <BuyerTin>{{$invoice->customer->npwp_customer}}</BuyerTin>
                <BuyerDocument>{{$request->get('buyer_id_type')}}</BuyerDocument>
                <BuyerCountry>IDN</BuyerCountry>

                @if($request->get('number_document_buyer'))
                    <BuyerDocumentNumber>{{$request->get('number_document_buyer')}}</BuyerDocumentNumber>
                @else
                    <BuyerDocumentNumber>-</BuyerDocumentNumber>
                @endif

                <BuyerName>{{$invoice->customer->name}}</BuyerName>
                <BuyerAdress>{{$invoice->customer->npwp_address}}</BuyerAdress>

                @if($request->get('email_buyer'))
                    <BuyerEmail> {{$request->get('email_buyer')}} </BuyerEmail>
                @else
                    <BuyerEmail/>
                @endif

                <BuyerIDTKU>{{$invoice->customer->id_tku_customer}}</BuyerIDTKU>

                <ListOfGoodService>
                    @foreach($invoice->products as $item)
                        @php
                            $unit = "UM.0033";
                            if ($item->unit == "pcs") {
                                $unit = "UM.0021";
                            }
                        @endphp
                        <GoodService>
                            <Opt>A</Opt>
                            <Code>000000</Code>
                            <Name>{{$item->name}}</Name>
                            <Unit>{{$unit}}</Unit>
                            <Price>{{ceil($item->rate)}}</Price>
                            <Qty>{{$item->quantity}}</Qty>
                            <TotalDiscount>{{ceil($item->calculate($ppn)["discount_total"])}}</TotalDiscount>
                            <TaxBase>{{ceil($item->calculate($ppn)["dpp"])}}</TaxBase>
                            <OtherTaxBase>{{ceil($item->calculate($ppn)["dpp_etc_value"])}}</OtherTaxBase>
                            <VATRate>12</VATRate>
                            <VAT>{{ceil($item->calculate($ppn)["ppn12"])}}</VAT>
                            <STLGRate>0</STLGRate>
                            <STLG>0</STLG>
                        </GoodService>
                    @endforeach
                </ListOfGoodService>
            </TaxInvoice>
        @endforeach
    </ListOfTaxInvoice>
</TaxInvoiceBulk>
