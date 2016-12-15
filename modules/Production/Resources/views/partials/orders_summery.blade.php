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
                            <div class="panel-heading">
                                <a href="#collapseOne2" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle collapsed">
                                    New Requisition
                                </a>
                            </div>
                            <div class="panel-collapse in collapse" id="collapseOne2">
                                <form method="post" enctype="multipart/form-data" name="myForm" novalidate>
                                    <div class="panel-body">
                                        <code>Yarn Type</code>
                                        <input class="form-control col-sm-2" placeholder="Yarn Type" type="text" ng-model="yarn_type">
                                    </div>
                                    <div class="panel-body">
                                        <code>Yarn Amount</code>
                                        <input class="form-control col-sm-2" placeholder="Yarn Amount" type="text" ng-model="yarn_amount">
                                    </div>
                                    <div class="panel-body">
                                        <code>Accessories</code>## no_of_requisition_items ##
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
                                    <div class="panel-body text-center">
                                        <button ng-click="add_to_requisitions()" type="submit" class="btn btn-warning">Add to Requisitions</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="#collapseTwo2" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                    Inactive Orders
                                </a>
                            </div>
                            <div class="panel-collapse collapse" id="collapseTwo2">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="#collapseThree2" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                                    Delivered Soon
                                </a>
                            </div>
                            <div class="panel-collapse collapse" id="collapseThree2">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>