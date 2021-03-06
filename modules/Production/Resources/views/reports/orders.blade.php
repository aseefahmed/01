@extends('layouts/dashboard/main')
@section('page_title', 'Report: Orders')

@section('content')

    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row" ng-controller="OrderController" ng-cloak>
        <div>
            @include('production::partials.advanced_order_search_form')
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="col-sm-12">
                <div class="w-box" id="w_sort01">
                    <div class="w-box-header">
                        <div class="pull-left">
                            <div class="btn-group">
                                <a class="btn dropdown-toggle btn-primary btn-xs" data-toggle="dropdown" href="#">
                                    <i class="glyphicon glyphicon-cog"></i> Action <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a data-toggle="modal" data-backdrop="static" href="#add-order-modal"><span class="glyphicon glyphicon-plus-sign"></span> Add Order</a></li>
                                    <li><a href="#" ng-click="remove_order(0, 'index_page', 'selected')"><span class="glyphicon glyphicon-trash"></span> Delete Seleted</a></li>
                                    <li><a href="#" ng-click="remove_order(0, 'index_page', 'all')"><span class="glyphicon glyphicon-repeat"></span> Delete All</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-box-content cnt_a">
                        <div id="main-content">
                            <div class="row">
                                <div class="col-sm-4 text-left">
                                    <input type="text" class="form-control" placeholder="Search" ng-model="search_filter">
                                </div>
                                <div class="col-sm-8 text-right">
                                    <select  class="inline-search" style="width: 25%;" ng-model="num_of_items" name="num_of_items" ng-options="num.id as num.value for num in num_of_items_arr ">
                                        <option value="">Show</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 text-center">
                                        <dir-pagination-controls
                                                direction-links="true" auto-hide="false"
                                                boundary-links="true" >
                                        </dir-pagination-controls>
                                    </div>
                                    <table class="table table-responsive table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Image</th>
                                            <th class="th-pointer" ng-click="sort('buyer_id')">Buyer<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='buyer_id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('buyer_id')">Style<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='buyer_id'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('order_ddate')">Order Date <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='order_ddate'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('gg')">GG <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='gg'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('qty')">Qty<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='qty'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('total_fob')">Total FOB<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='total_fob'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('total_cost')">Total Cost<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='total_cost'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('balance_amount')">Balance Amount<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='balance_amount'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('cost_of_making')">COM<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='cost_of_making'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('delivery_date')">Delivery Date<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='delivery_date'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-if="orders.length == 0 || filtered.length == 0">
                                            <td colspan="12">No data found.</td>
                                        </tr>
                                        <tr dir-paginate="order in filtered = (orders| orderBy : sortKey : reverse | filter : search_filter  | itemsPerPage : num_of_items) " ng-cloak>
                                            <td>## $index+1 ##</td>
                                            <td ng-cloak><img src="{{ asset('img/uploads/production/styles') }}/## order.style_image ##" width="80px"/></td>
                                            <td ng-cloak>## order.buyer_name ##</td>
                                            <td ng-cloak>## order.style_name ##</td>
                                            <td ng-cloak>## order.order_date##</td>
                                            <td ng-cloak>## order.gg ##</td>
                                            <td ng-cloak>## order.qty | currency ##</td>
                                            <td ng-cloak>## order.total_fob | currency ##</td>
                                            <td ng-cloak>## order.total_cost | currency ##</td>
                                            <td ng-cloak>## order.balance_amount | currency ##</td>
                                            <td ng-cloak>## order.cost_of_making | currency ##</td>
                                            <td ng-cloak>## order.delivery_date ##</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <div class="col-sm-12 text-center">
                                        <dir-pagination-controls
                                                direction-links="true" auto-hide="false"
                                                boundary-links="true" >
                                        </dir-pagination-controls>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add-order-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Add Order</h3>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data" name="myForm" novalidate>
                                <input type="hidden" ng-model="order.compositions" />
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Buyer </label>
                                            <select class="inline-search" style="width: 85%;" ng-model="order.buyer_id" ng-pattern="/^\d+$/" ng-required="true">
                                                <option value="">Select a buyer</option>
                                                <option ng-repeat="buyer in buyers" value="## buyer.id ##">
                                                    ## buyer.buyer_name ##
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Style </label>
                                            <select class="inline-search" style="width: 85%;" ng-model="order.style_id" ng-pattern="/^\d+$/" ng-required="true">
                                                <option value="">Select a style</option>
                                                <option ng-repeat="style in styles" value="## style.id ##">
                                                    ## style.style_name ##
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Order Date </label>
                                            <input class="form-control" type="text" placeholder="YYYY-MM-DD" ng-model="order.order_date" ng-required="true" ng-pattern="/^\d{4}-\d{2}-\d{2}$/" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Delivery Date </label>
                                            <input class="form-control" placeholder="YYYY-MM-DD" type="text" ng-model="order.delivery_date" ng-pattern="/^\d{4}-\d{2}-\d{2}$/" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>GG</label>
                                            <input class="form-control" placeholder="GG" type="text" ng-model="order.order_gg" ng-pattern="/^\d+$/" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Qty</label>
                                            <input class="form-control" placeholder="Qty" type="text" ng-model="order.order_qty" ng-required="true" ng-pattern="/^\d+$/" ng-change="update_order_info()" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>FOB</label>
                                            <input class="form-control" placeholder="FOB" type="text" ng-model="order.order_fob" ng-required="true"  ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" ng-change="update_order_info()"  />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Weight Per Dzn</label>
                                            <input class="form-control" placeholder="Weight Per Dzn" type="text" ng-required="true" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" ng-model="order.weight_per_dzn" ng-change="update_order_info()"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="formSep bg-warning">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3 class="heading">Composition</h3>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="text-center">Name</label>
                                            <input class="form-control" ng-model="composition_name" type="text" placeholder="Name">
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Percentage</label>
                                            <input class="form-control" ng-model="composition_percentage" type="text" placeholder="Percentage" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" >
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Yarn Rate</label>
                                            <input class="form-control" ng-model="composition_yarn_rate" type="text" placeholder="Cost" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" >
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Wastage(%)</label>
                                            <input class="form-control" ng-model="composition_wastage" type="text" placeholder="Wastage" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" >
                                        </div>
                                        <div class="col-sm-2">
                                            <a class="btn btn-success" ng-click="add_composition()"><i class="glyphicon glyphicon-plus-sign"></i></a>
                                            <a class="btn btn-primary" ng-click="composition_refresh()"><i class="glyphicon glyphicon-refresh"></i></a>
                                        </div>
                                        <div class="col-sm-10">
                                            <table id="composition-div-group" class="table table-responsive">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Qty Per Dzn</label>
                                            <input class="form-control" placeholder="Qty Per Dzn" type="text" ng-model="order.qty_per_dzn" readonly="readonly"/>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Total Yarn Weight</label>
                                            <input class="form-control" placeholder="Total Yarn Weight" type="text" ng-model="order.total_yarn_weight" readonly="readonly" />
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Total Yarn Cost</label>
                                            <input class="form-control" placeholder="Total Yarn Cost" type="text" ng-model="order.total_yarn_cost" readonly="readonly"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Accessories Rate</label>
                                            <input class="form-control" placeholder="Accessories Rate" type="text" ng-model="order.accessories_rate" ng-required="true" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" ng-change="update_order_info()" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Acc. Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Acc. Cost" type="text" ng-model="order.total_accessories_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Button Rate</label>
                                            <input class="form-control" placeholder="Button Rate" type="text" ng-model="order.button_rate" ng-required="true" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" ng-change="update_order_info()" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Button Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Btn Cost" type="text" ng-model="order.total_button_cost" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Zipper Rate</label>
                                            <input class="form-control" placeholder="Zipper Rate" type="text" ng-model="order.zipper_rate" ng-required="true"  ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" ng-change="update_order_info()" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Zipper Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Zipp. Cost" type="text" ng-model="order.total_zipper_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Print Rate</label>
                                            <input class="form-control" placeholder="Print Rate" type="text" ng-model="order.print_rate" ng-required="true"  ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" ng-change="update_order_info()" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Print Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Prt. Cost" type="text" ng-model="order.total_print_cost" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-6 ">
                                            <label>Security Tag Cost</label>
                                            <input class="form-control" placeholder="Security Tag Cost" type="text" ng-model="order.security_tag" ng-required="true"  ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" ng-change="update_order_info()" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Total Security Tag Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Security Tag Cost" type="text" ng-model="order.total_security_tag_cost" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Total FOB</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total FOB" type="text" ng-model="order.total_fob" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Cost" type="text" ng-model="order.total_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Balance Amount</label>
                                            <input class="form-control" readonly="readonly" placeholder="Balance Amount" type="text" ng-model="order.order_balance_amount" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Cost of Making</label>
                                            <input class="form-control" readonly="readonly" disabled="disabled" placeholder="Cost of Making" type="text" ng-model="order.cost_of_making" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                    <button type="submit" ng-disabled="myForm.$invalid" name="commit" class="btn btn-success" ng-click="add_order(myForm)"><span class="glyphicon glyphicon-ok-sign"></span> Add Order </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="remove-order-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove Order</h3>
                        </div>
                        <div class="modal-body">
                            ## modal_msg ##
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_order_confirmed(order_id, 'index_page', status)" order_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>,

            <div class="modal fade" id="removal-warning-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove Order</h3>
                        </div>
                        <div class="modal-body">
                            Please Select at least one order.
                            <div class="modal-footer">
                                <a class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-ok-sign"></span> OK</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection