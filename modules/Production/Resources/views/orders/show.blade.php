@extends('layouts/dashboard/main')
@section('page_title', 'Orders')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row" ng-controller="OrderController" ng-init="init({{$order_id}})" ng-cloak>
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
                                    <li><a href="/production/orders" target="_top"><span class="glyphicon glyphicon-arrow-left"></span> Cancel</a></li>
                                    <li><a ng-if="order[0].user_id == {{ Auth::user()->id }}" class="th-pointer" ng-click="remove_order({{ $order_id  }}, order[0].order_name, 'single_delete')"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-box-content cnt_a">
                        <div id="main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th width='25%'>Buyer: </th>
                                            <td><span class="col-sm-10">## order[0].order_name ##</span><a ng-click="edit_order({{ $order_id  }}, 'Order', 'order_name', 'text', true, '', 50, '', 'This is a mendatory field (Maximum: 50 Characters).')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                            <td rowspan="2" width="25%"><img src="{{ asset('img/uploads/production/orders') }}/## order[0].image ##" width="100%" height="100%"></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Order Date: </th>
                                            <td><span class="col-sm-10 wordwrap">## order[0].order_date ## </span><a ng-click="edit_order({{ $order_id  }}, 'Order Date', 'order_date', 'text', true, '', 70, '', 'Date should be in YYYY-MM-DD format.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Delivery Date: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].delivery_date | uppercase ## </span><a ng-click="edit_order({{ $order_id  }}, 'Delivery Date', 'delivery_date', 'text', true, '', 70, '', 'Date should be in YYYY-MM-DD format.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>GG: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].gg ## </span><a ng-click="edit_order({{ $order_id  }}, 'GG', 'gg', 'text', true, '', 70, '', 'This field must be a number')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Qty: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].qty ## </span><a ng-click="edit_order({{ $order_id  }}, 'Qty', 'qty', 'text', true, '', 70, '', 'This field must be a number.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>FOB: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].fob ## </span><a ng-click="edit_order({{ $order_id  }}, 'FOB', 'fob', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Weight Per Dzn: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].weight_per_dzn ## </span><a ng-click="edit_order({{ $order_id  }}, 'Weight Per Dzn', 'weight_per_dzn', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Qty Per Dzn: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].qty_per_dzn ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Total Yarn Weight: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].total_yarn_weight ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Total Yarn Cost: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].total_yarn_cost ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Accessories Rate: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].acc_rate ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Total Accessories Cost: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].total_acc_cost  ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Button Rate: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].btn_cost ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Total Button Cost: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].total_btn_cost ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'true', false, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Zipper Rate: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].zipper_cost ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Total Zipper Cost: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].total_zipper_cost## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Print Cost: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].print_cost ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Total Print Cost: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].total_print_cost ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Total FOB: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].total_fob ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Total Cost: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].total_cost  ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Balance Amount: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].balance_amount  ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Cost of Making: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0]. cost_of_making  ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>L/C Confirmed?: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].lc_confirmed  ## </span><a ng-click="edit_order({{ $order_id  }}, 'Contact Person', 'contact_person', 'text', true, '', 70, '', 'This field not be more than 55 characters long.')" class="th-pointer col-sm-2 glyphicon glyphicon-pencil text-right"></a></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Created By: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].user.first_name | uppercase ## ## order[0].user.last_name | uppercase ## </span></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Created At: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].created_at | filterDate ## </span></td>
                                        </tr>
                                        <tr>
                                            <th width='25%'>Updated At: </th>
                                            <td colspan="2"><span class="col-sm-10">## order[0].updated_at | filterDate ## </span></td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                @include('production::partials.orders_stats')
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
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_order_confirmed(order_id, 'show_page', status)" order_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

            <div class="modal fade" id="edit-order-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Edit Order</h3>
                        </div>
                        <div class="modal-body">
                            <form name="myForm" method="post" enctype="multipart/form-data" novalidate>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code> ## editable_item ## </code> <span style="color:red">*</span>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="## editable_item ##" name="this_field" type="## field_type ##" ng-required="## is_required ##" ng-minlength="## min_length ##" ng-maxlength="## max_length ##" ng-pattern="## pattern ##" ng-model="type"/>
                                            <span class="help-block " ng-show="myForm.this_field.$dirty && myForm.this_field.$invalid">## error_text ##</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                    <button type="submit" name="commit" class="btn btn-success" ng-disabled="myForm.$invalid" ng-click="edit_order_confirmed({{ $order_id }})"><span class="glyphicon glyphicon-ok-sign"></span> Edit  </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection