@extends('layouts/dashboard/main')
@section('page_title', 'Orders')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row" ng-controller="OrderController" ng-cloak>
        <div class="col-sm-12 col-md-12">
            <div class="col-sm-8">
                <div class="w-box" id="w_sort01">
                    <div class="w-box-header">
                        <div class="pull-left">
                            <div class="btn-group">
                                <a class="btn dropdown-toggle btn-primary btn-xs" data-toggle="dropdown" href="#">
                                    <i class="glyphicon glyphicon-cog"></i> Action <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a data-toggle="modal" data-backdrop="static" href="#add-order-modal"><span class="glyphicon glyphicon-plus-sign"></span> Add</a></li>
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
                                    Show : <select style="width: 25%;" ng-model="num_of_items" name="num_of_items" ng-options="num.id as num.value for num in num_of_items_arr ">
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
                                            <th class="th-pointer" ng-click="sort('order_name')">Order Name <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='order_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('created_at')">Contact Person <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='created_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('updated_at')">Email Address <span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='updated_at'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-if="orders.length == 0 || filtered.length == 0">
                                            <td colspan="6">No data found.</td>
                                        </tr>
                                            <tr dir-paginate="order in filtered = (orders| orderBy : sortKey : reverse | filter : search_filter  | itemsPerPage : num_of_items) " ng-cloak>
                                                <td><input class="select_row" type="checkbox"  value="## order.id ##"/></td>
                                                <td ng-cloak><img src="{{ asset('img/uploads/production/orders') }}/## order.image ##" width="80px"/></td>
                                                <td ng-cloak>## order.order_name ##</td>
                                                <td ng-cloak>## order.contact_person ##</td>
                                                <td ng-cloak>## order.email_address ##</td>
                                                <td  ng-cloak align="center">
                                                    <a class="btn btn-primary" href="{{ url('production/orders/') }}/## order.id ##"><i class="glyphicon glyphicon-eye-open" class="view_order_btn"></i></a>&nbsp;
                                                    <a ng-if="order.user_id == {{ Auth::user()->id }}" class="btn btn-danger" ng-click="remove_order(order.id, order.order_name, 'single_delete')" order_name="## order.name ##" order_id="## order.id ##"><i class="glyphicon glyphicon-trash"></i></a>
                                                </td>
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
            <div class="col-sm-4">
                @include('production::partials.orders_stats')
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
                                <input type="hidden" name="order[compositions]" id="order_compositions" />
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Buyer </label>
                                            <select class="form-control" ng-model="buyer_id">
                                                <option value="">Select a buyer</option>
                                                <option ng-repeat="buyer in buyers" value="## buyer.id ##">
                                                    ## buyer.buyer_name ##
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Style </label>
                                            <select class="form-control" ng-model="style_id">
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
                                            <input class="form-control inputmaskjs" placeholder="Order Date" type="text" name="order[order_date]" id="order_order_date" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Delivery Date </label>
                                            <input class="form-control inputmaskjs" placeholder="Order Date" type="text" name="order[delivery_date]" id="order_delivery_date" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>GG</label>
                                            <input class="form-control" placeholder="GG" type="text" name="order[gg]" id="order_gg" />
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Qty</label>
                                            <input class="form-control" placeholder="Qty" type="text" name="order[qty]" id="order_qty" />
                                        </div>
                                        <div class="col-sm-4">
                                            <label>FOB</label>
                                            <input class="form-control" placeholder="FOB" type="text" name="order[fob]" id="order_fob" />
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
                                            <input class="form-control" name="composition_name"  id="composition_name" type="text" placeholder="Name">
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Percentage</label>
                                            <input class="form-control" name="composition_percentage" id="composition_percentage" type="text" placeholder="Percentage">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Yarn Rate</label>
                                            <input class="form-control" name="composition_yarn_rate" id="composition_yarn_rate" type="text" placeholder="Cost">
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Wastage(%)</label>
                                            <input class="form-control" name="composition_wastage" id="composition_wastage" type="text" placeholder="Wastage">
                                        </div>
                                        <div class="col-sm-2">
                                            <a class="btn btn-success" id="composition_plus"><i class="glyphicon glyphicon-plus-sign"></i></a>
                                            <a class="btn btn-primary" id="composition_refresh"><i class="glyphicon glyphicon-refresh"></i></a>
                                        </div>
                                        <div id="composition-div-group">
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Weight Per Dzn</label>
                                            <input class="form-control" placeholder="Weight Per Dzn" type="text" name="order[weight_per_dzn]" id="order_weight_per_dzn" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Qty Per Dzn</label>
                                            <input class="form-control" placeholder="Qty Per Dzn" type="text" name="order[qty_per_dzn]" id="order_qty_per_dzn" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Yarn Weight</label>
                                            <input class="form-control" placeholder="Total Yarn Weight" type="text" name="order[total_yarn_weight]" id="order_total_yarn_weight" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Yarn Cost</label>
                                            <input class="form-control" placeholder="Total Yarn Cost" type="text" name="order[total_yarn_cost]" id="order_total_yarn_cost" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Accessories Rate</label>
                                            <input class="form-control" placeholder="Accessories Rate" type="text" name="order[acc_rate]" id="order_acc_rate" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Acc. Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Acc. Cost" type="text" name="order[total_acc_cost]" id="order_total_acc_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Button Rate</label>
                                            <input class="form-control" placeholder="Button Rate" type="text" name="order[btn_cost]" id="order_btn_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Button Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Btn Cost" type="text" name="order[total_btn_cost]" id="order_total_btn_cost" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Zipper Rate</label>
                                            <input class="form-control" placeholder="Zipper Rate" type="text" name="order[zipper_cost]" id="order_zipper_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Zipper Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Zipp. Cost" type="text" name="order[total_zipper_cost]" id="order_total_zipper_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Print Rate</label>
                                            <input class="form-control" placeholder="Print Rate" type="text" name="order[print_cost]" id="order_print_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Print Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Prt. Cost" type="text" name="order[total_print_cost]" id="order_total_print_cost" />
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Total FOB</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total FOB" type="text" name="order[total_fob]" id="order_total_fob" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Total Cost</label>
                                            <input class="form-control" readonly="readonly" placeholder="Total Cost" type="text" name="order[total_cost]" id="order_total_cost" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Balance Amount</label>
                                            <input class="form-control" readonly="readonly" placeholder="Balance Amount" type="text" name="order[balance_amount]" id="order_balance_amount" />
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Cost of Making</label>
                                            <input class="form-control" readonly="readonly" disabled="disabled" placeholder="Cost of Making" type="text" name="order[cost_of_making]" id="order_cost_of_making" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                    <button type="submit" name="commit" class="btn btn-success" ng-click="add_order()"><span class="glyphicon glyphicon-ok-sign"></span> Add Order </button>
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