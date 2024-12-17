<div class="card card-flush overflow-hidden h-lg-100">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <!--begin::Title-->
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Penjualan</span>
            {{--            <span class="text-gray-400 mt-1 fw-semibold fs-6">1,046 Inbound Calls today</span>--}}
        </h3>
        <!--end::Title-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
            <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                 data-kt-daterangepicker-range="today" class="btn btn-sm btn-light d-flex align-items-center px-4">
                <!--begin::Display range-->
                <div class="text-gray-600 fw-bold">Loading date range...</div>
                <!--end::Display range-->
                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                <span class="svg-icon svg-icon-1 ms-2 me-0">
																<svg width="24" height="24" viewBox="0 0 24 24"
                                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path opacity="0.3"
                                                                          d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                                          fill="currentColor"/>
																	<path
                                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                        fill="currentColor"/>
																	<path
                                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                        fill="currentColor"/>
																</svg>
															</span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Daterangepicker-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Card body-->
    <div class="card-body d-flex align-items-end p-0">
        <!--begin::Chart-->
        <div id="penjualan_chart_dashboard" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>
        <!--end::Chart-->
    </div>
    <!--end::Card body-->
</div>
@push('script')
    <script>
        var element = document.getElementById("penjualan_chart_dashboard");

        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        var baseprimaryColor = KTUtil.getCssVariableValue('--bs-primary');
        var lightprimaryColor = KTUtil.getCssVariableValue('--bs-primary');
        var basesuccessColor = KTUtil.getCssVariableValue('--bs-success');
        var lightsuccessColor = KTUtil.getCssVariableValue('--bs-success');

        var categories = [
            '01/09/24', '02/09/24', '03/09/24', '04/09/24', '05/09/24', '06/09/24', '07/09/24', '08/09/24', '09/09/24', '10/09/24', '11/09/24', '12/09/24',
            '13/09/24', '14/09/24', '15/09/24', '16/09/24', '17/09/24', '18/09/24', '19/09/24', '20/09/24', '21/09/24', '22/09/24', '23/09/24', '24/09/24',
            '25/09/24', '26/09/24', '27/09/24', '28/09/24', '29/09/24', '30/09/24', '01/10/24', '02/10/24', '03/10/24', '04/10/24', '05/10/24', '06/10/24',
            '07/10/24', '08/10/24', '09/10/24', '10/10/24', '11/10/24', '12/10/24', '13/10/24', '14/10/24', '15/10/24', '16/10/24', '17/10/24', '18/10/24',
            '19/10/24', '20/10/24', '21/10/24', '22/10/24', '23/10/24', '24/10/24', '25/10/24', '26/10/24', '27/10/24', '28/10/24', '29/10/24', '30/10/24',
            '31/10/24', '01/11/24', '02/11/24', '03/11/24', '04/11/24', '05/11/24', '06/11/24', '07/11/24', '08/11/24', '09/11/24', '10/11/24', '11/11/24',
            '12/11/24', '13/11/24', '14/11/24', '15/11/24', '16/11/24', '17/11/24', '18/11/24', '19/11/24', '20/11/24', '21/11/24', '22/11/24', '23/11/24',
            '24/11/24', '25/11/24', '26/11/24', '27/11/24', '28/11/24', '29/11/24', '30/11/24', '01/12/24', '02/12/24', '03/12/24', '04/12/24', '05/12/24',
            '06/12/24', '07/12/24', '08/12/24', '09/12/24', '10/12/24', '11/12/24', '12/12/24', '13/12/24', '14/12/24', '15/12/24', '16/12/24', '17/12/24',
            '18/12/24', '19/12/24', '20/12/24', '21/12/24', '22/12/24', '23/12/24', '24/12/24', '25/12/24', '26/12/24', '27/12/24', '28/12/24', '29/12/24',
            '30/12/24', '31/12/24', '01/01/25', '02/01/25', '03/01/25', '04/01/25', '05/01/25', '06/01/25', '07/01/25', '08/01/25', '09/01/25', '10/01/25',
            '11/01/25', '12/01/25', '13/01/25', '14/01/25', '15/01/25', '16/01/25', '17/01/25', '18/01/25', '19/01/25', '20/01/25', '21/01/25', '22/01/25',
            '23/01/25', '24/01/25', '25/01/25', '26/01/25', '27/01/25', '28/01/25', '29/01/25', '30/01/25', '31/01/25', '01/02/25', '02/02/25', '03/02/25',
            '04/02/25', '05/02/25', '06/02/25', '07/02/25', '08/02/25', '09/02/25', '10/02/25', '11/02/25', '12/02/25', '13/02/25', '14/02/25', '15/02/25',
            '16/02/25', '17/02/25', '18/02/25', '19/02/25', '20/02/25', '21/02/25', '22/02/25', '23/02/25', '24/02/25', '25/02/25', '26/02/25', '27/02/25',
            '28/02/25'
        ];

        var options = {
            series: [{
                name: 'Realisasi Penjualan',
                data: [
                    6080000, 4723000, 5503000, 5936000, 5166000, 6038000, 4348000,
                    3847000, 4742000, 4101000, 4609000, 5686000, 6004000, 6180000,
                    4494000, 4911000, 5423000, 4610000, 5238000, 5920000, 4228000,
                    4292000, 4161000, 4799000, 5014000, 5030000, 5249000, 4849000,
                    5393000, 5885000, 4196000, 4631000, 5216000, 4271000, 5120000,
                    4692000, 3854000, 4275000, 5053000, 5154000, 4156000, 4496000,
                    4373000, 4255000, 5605000, 4794000, 5011000, 4355000, 4824000,
                    5392000, 4949000, 4766000, 4481000, 5576000, 5866000, 5931000,
                    4309000, 5750000, 4372000, 5732000, 4293000, 5779000, 5374000,
                    5586000, 4459000, 5121000, 4832000, 4794000, 6458000, 5500000,
                    4156000, 5748000, 5618000, 6127000, 6156000, 5419000, 5185000,
                    5731000, 4597000, 5391000, 3870000, 4667000, 4977000, 5250000,
                    5094000, 5023000, 5659000, 5379000, 4719000, 5459000, 5458000,
                    5070000, 5081000, 5959000, 4942000, 5948000, 4715000, 5625000,
                    3957000, 4150000, 4844000, 5133000, 5430000, 4589000, 4471000,
                    4414000, 5334000, 5471000, 4513000, 4624000, 3668000, 4950000,
                    4039000, 4489000, 4134000, 5049000, 4311000, 6303000, 5471000,
                    3881000, 4901000, 5428000, 5888000, 5378000, 5023000, 3910000,
                    6154000, 3981000, 5111000, 4186000, 4090000, 4935000, 5772000,
                    4074000, 4801000, 5294000, 5250000, 5008000, 4791000, 4082000,
                    3778000, 5103000, 3868000, 5834000, 4658000, 4848000, 6285000,
                    4037000, 5868000, 5263000, 5676000, 6256000, 5574000, 5427000,
                    4568000, 5767000, 5792000, 4187000, 4306000, 4196000, 4829000,
                    4953000, 4442000, 5185000, 5134000, 3996000, 5983000, 4916000,
                    5384000, 4005000, 5528000, 4863000, 5600000, 4354000, 5066000,
                    4577000, 3753000, 6264000, 5167000, 5337000, 4569000
                ]
            }, {
                name: 'Target Penjualan',
                data: [
                    5853000, 4653000, 5042000, 5689000, 5079000, 5931000, 4552000, 4331000, 4847000, 4587000,
                    4398000, 5580000, 5853000, 5830000, 4899000, 4742000, 5332000, 4549000, 4766000, 5698000,
                    4472000, 4081000, 4222000, 4403000, 4951000, 5391000, 5209000, 4406000, 5198000, 5761000,
                    4591000, 4913000, 4833000, 4649000, 4713000, 4544000, 4001000, 4610000, 5068000, 5385000,
                    4488000, 4438000, 4808000, 4508000, 5393000, 4296000, 4534000, 4822000, 4690000, 5361000,
                    4896000, 5185000, 4739000, 5606000, 5967000, 5633000, 4301000, 5392000, 4652000, 5422000,
                    4697000, 5881000, 5036000, 5351000, 4418000, 5392000, 4350000, 5033000, 5993000, 5117000,
                    4377000, 5401000, 5713000, 5776000, 5871000, 5338000, 4745000, 5947000, 4611000, 4897000,
                    4352000, 4988000, 4733000, 5442000, 5085000, 5273000, 5180000, 4973000, 4869000, 5290000,
                    5728000, 4998000, 5537000, 5989000, 4559000, 5495000, 4662000, 5145000, 4151000, 4382000,
                    4971000, 4789000, 5860000, 4418000, 4717000, 4591000, 5697000, 5418000, 4593000, 4512000,
                    4163000, 5256000, 4142000, 4102000, 4055000, 4877000, 4656000, 5964000, 5721000, 4078000,
                    5074000, 5656000, 5931000, 5684000, 4823000, 4277000, 5939000, 4082000, 4867000, 4502000,
                    4162000, 5377000, 5830000, 4480000, 4366000, 5277000, 5314000, 5460000, 5132000, 4240000,
                    4184000, 4623000, 4351000, 5527000, 4693000, 5300000, 5898000, 4522000, 5867000, 5079000,
                    5232000, 5889000, 5273000, 5354000, 4257000, 5641000, 5641000, 4413000, 4429000, 4078000,
                    4673000, 4771000, 4681000, 4992000, 4697000, 4078000, 5935000, 4847000, 5152000, 4255000,
                    5161000, 5124000, 5360000, 4476000, 5069000, 4779000, 4200000, 5917000, 4710000, 5354000,
                    4986000
                ]
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {},
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.2,
                    stops: [15, 120, 100]
                }
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [baseprimaryColor, basesuccessColor]
            },
            xaxis: {
                categories: categories,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: true
                },
                tickAmount: 2,
                // tickPlacement: 'between',
                labels: {
                    rotate: 0,
                    rotateAlways: true,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    },
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: [baseprimaryColor, basesuccessColor],
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                max: 6458000,
                min: 3668000,
                tickAmount: 6,
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    },
                    formatter: function (value) {
                        return 'Rp. '+ value.toLocaleString('id-ID', { style: 'decimal', currency: 'IDR' });
                    }
                }
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                }
            },
            colors: [lightprimaryColor, lightsuccessColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: [baseprimaryColor, basesuccessColor],
                strokeWidth: 3
            }
        };

        chart = new ApexCharts(element, options);

        // Set timeout to properly get the parent elements width
        setTimeout(function () {
            chart.render();
            chart.rendered = true;
        }, 200);
    </script>
@endpush