<x-card title="Account Receivable" shadow="sm" id="account_receivable_card">
    <x-tabs :tabs="[
                        [
                            'id'=>'crm_tab_role',
                            'title'=>'CRM'
                        ],
                        [
                            'id'=>'list_of_customer_role_tabs',
                            'title'=>'Customer'
                        ]
                    ]">
        @slot('slot0')
            <x-card title="Sales Mapping" id="sales_mapping_role" shadow="sm">
                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="view_sales_mapping_all_position"/>
                            <label class="form-check-label" for="view_sales_mapping_all_position">
                                View Sales Mapping (View All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="view_sales_mapping_subcoordinate"/>
                            <label class="form-check-label" for="view_sales_mapping_subcoordinate">
                                View Sales Mapping (View Sub Coordinate)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="view_sales_mapping_one_self"/>
                            <label class="form-check-label" for="view_sales_mapping_one_self">
                                View Sales Mapping (One Self)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="create_sales_mapping_all_position"/>
                            <label class="form-check-label" for="create_sales_mapping_all_position">
                                Create Sales Mapping (Create All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="create_sales_mapping_subcoordinate"/>
                            <label class="form-check-label" for="create_sales_mapping_subcoordinate">
                                Create Sales Mapping (Create Sub Coordinate)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="create_sales_mapping_one_self"/>
                            <label class="form-check-label" for="create_sales_mapping_one_self">
                                Create Sales Mapping (One Self)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="edit_sales_mapping_all_position"/>
                            <label class="form-check-label" for="edit_sales_mapping_all_position">
                                Edit Sales Mapping (Edit All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="edit_sales_mapping_subcoordinate"/>
                            <label class="form-check-label" for="edit_sales_mapping_subcoordinate">
                                Edit Sales Mapping (Edit Sub Coordinate)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="edit_sales_mapping_one_self"/>
                            <label class="form-check-label" for="edit_sales_mapping_one_self">
                                Edit Sales Mapping (One Self)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="delete_sales_mapping_all_position"/>
                            <label class="form-check-label" for="delete_sales_mapping_all_position">
                                Delete Sales Mapping (Delete All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="delete_sales_mapping_subcoordinate"/>
                            <label class="form-check-label" for="delete_sales_mapping_subcoordinate">
                                Delete Sales Mapping (Delete Sub Coordinate)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1"
                                   id="delete_sales_mapping_one_self"/>
                            <label class="form-check-label" for="delete_sales_mapping_one_self">
                                Delete Sales Mapping (One Self)
                            </label>
                        </div>
                    </div>
                </div>
            </x-card>

            <x-card title="Sales Approval" id="sales_approval_role" shadow="sm">
                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="view_sales_approval_all_position"/>
                            <label class="form-check-label" for="view_sales_approval_all_position">
                                View Sales Approval (View All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="view_sales_approval_subordinates"/>
                            <label class="form-check-label" for="view_sales_approval_subordinates">
                                View Sales Approval (View Subordinates)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="approve_reject_sales_all_position"/>
                            <label class="form-check-label" for="approve_reject_sales_all_position">
                                Approve & Reject Sales (All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="approve_reject_sales_subordinates"/>
                            <label class="form-check-label" for="approve_reject_sales_subordinates">
                                Approve & Reject Sales (Subordinates)
                            </label>
                        </div>
                    </div>
                </div>
            </x-card>

            <x-card title="Sales Confirm Visit" id="sales_confirm_visit_role" shadow="sm">
                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="view_visit_all_position"/>
                            <label class="form-check-label" for="view_visit_all_position">
                                View Visit (View All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="view_visit_one_self"/>
                            <label class="form-check-label" for="view_visit_one_self">
                                View Visit (View One-Self)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="confirm_visit_all_position"/>
                            <label class="form-check-label" for="confirm_visit_all_position">
                                Confirm Visit (Confirm All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="confirm_visit_one_self"/>
                            <label class="form-check-label" for="confirm_visit_one_self">
                                Confirm Visit (Confirm One-Self)
                            </label>
                        </div>
                    </div>
                </div>

            </x-card>

            <x-card title="Sales Visit Report" id="sales_visit_report" shadow="sm">
                <div class="col-12 col-md-3 mb-5 row">
                    <div class="d-flex flex-column">
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="view_visit_report_all_position"/>
                            <label class="form-check-label" for="view_visit_report_all_position">
                                View Visit Report (View All Position)
                            </label>
                        </div>
                        <div class="form-check form-check-custom form-check-solid mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="view_visit_report_one_self"/>
                            <label class="form-check-label" for="view_visit_report_one_self">
                                View Visit Report (View One-Self)
                            </label>
                        </div>
                    </div>
                </div>
            </x-card>
        @endslot
        @slot('slot1')
        @endslot
    </x-tabs>

</x-card>
