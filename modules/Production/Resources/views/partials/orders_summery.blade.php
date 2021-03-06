<div class="w-box" id="w_sort01">
    <div class="w-box-header">
        <div class="pull-left">
            <div class="btn-group">
                Order Summery
            </div>
        </div>
    </div>
    <div class="w-box-content cnt_a">
        <div id="main-content">
            <div class="row">
                <div class="col-sm-12">
                    <div id="accordion2" class="panel-group accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading bg bg-primary">
                                <a href="#collapseOne2" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    New Requisition
                                </a>
                            </div>
                            <div class="panel-collapse collapse" id="collapseOne2">
                                <form method="post" enctype="multipart/form-data" name="myForm" novalidate>
                                    <div class="panel-body">
                                        <code>Yarn Type</code>
                                        <select class="form-control" ng-model="yarn_type">
                                            <option value="">select an option</option>
                                            <option ng-repeat="item in order['composition']" ng-value="item[0]">
                                                ## item[0] ##
                                            </option>
                                        </select>
                                    </div>
                                    <div class="panel-body">
                                        <code>Yarn Amount</code>
                                        <input class="form-control col-sm-2" ng-disabled="yarn_type==''" placeholder="Yarn Amount" type="text" ng-model="yarn_amount">
                                    </div>
                                    <div class="panel-body">
                                        <code>Accessories</code>
                                        <input class="form-control col-sm-2" placeholder="Accessories Amount" type="text" ng-model="accessories_amount">
                                    </div>
                                    <div class="panel-body">
                                        <code>Button: </code>
                                        <input class="form-control col-sm-2" placeholder="Button Amount" type="text" ng-model="button_amount">
                                    </div>
                                    <div class="panel-body">
                                        <code>Zipper:</code>
                                        <input class="form-control col-sm-2" placeholder="Zipper Amount" type="text" ng-model="zipper_amount">
                                    </div>
                                    <div class="panel-body">
                                        <code>Print</code>
                                        <input class="form-control col-sm-2" placeholder="Print Amount" type="text" ng-model="print_amount">
                                    </div>
                                    <div class="panel-body">
                                        <code>Security Tag Cost</code>
                                        <input class="form-control col-sm-2" placeholder="Security Tag Amount" type="text" ng-model="security_tag_amount">
                                    </div>
                                    <div class="panel-body text-center">
                                        <button ng-click="add_to_requisitions()" type="submit" class="btn btn-warning">Add to Requisitions</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="#collapseThree2" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                    Order Status
                                </a>
                            </div>
                            <div class="panel-collapse in collapse" id="collapseThree2">
                                <div class="panel-body">
                                    <div class="sidebar_info" style="width:100%">
                                        <ul class="list-unstyled">
                                            <li>
                                                <span class="act act-danger" ng-cloak>## order[0].updated_at | filterDate ##</span>
                                                <strong>Last activity</strong>
                                            </li>
                                            <li>
                                                <span class="act act-danger">## days_left_to_delivery | number:0 ##</span>
                                                <strong>Days left to delivery </strong>
                                            </li>
                                            <li>
                                                <span class="act act-warning">## order.total_requisition_pending ##</span>
                                                <strong>Number of requisition pending</strong>
                                            </li>
                                            <li>
                                                <span class="act act-warning">## order.total_requisition_approved ##</span>
                                                <strong>Number of requisition approved</strong>
                                            </li>
                                            <li>
                                                <span class="act act-warning">## order.total_requisition_rejected ##</span>
                                                <strong>Number of requisition rejected</strong>
                                            </li>
                                            <li>
                                                <span class="act act-success">## approved_amount_of_requisition | currency ##</span>
                                                <strong>Amount of requisition approved</strong>
                                            </li>
                                            <li>
                                                <table class="table table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-right">Requisition Approved</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th class="bg bg-primary">Yarn</th>
                                                            <th class="text-right">## order[0].approved_yarn_amount | currency ## (## (order[0].approved_yarn_amount / order[0].total_yarn_cost)*100 | number:2  ##%)</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg bg-primary">Accessories</th>
                                                            <th class="text-right">## order[0].approved_yarn_amount | currency ## (## (order[0].approved_acc_amount / order[0].total_acc_cost)*100 | number:2  ##%)</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg bg-primary">Button</th>
                                                            <th class="text-right">## order[0].approved_yarn_amount | currency ## (## (order[0].approved_btn_amount / order[0].total_btn_cost)*100 | number:2  ##%)</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg bg-primary">Print</th>
                                                            <th class="text-right">## order[0].approved_yarn_amount | currency ## (## (order[0].approved_print_amount / order[0].total_print_cost)*100 | number:2  ##%)</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg bg-primary">Zipper</th>
                                                            <th class="text-right">## order[0].approved_yarn_amount | currency ## (## (order[0].approved_zipper_amount / order[0].total_zipper_cost)*100 | number:2  ##%)</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="bg bg-primary">Security Tag</th>
                                                            <th class="text-right">## order[0].approved_yarn_amount | currency ## (## (order[0].approved_security_tag_cost / order[0].total_security_tag_cost)*100 | number:2  ##%)</th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>