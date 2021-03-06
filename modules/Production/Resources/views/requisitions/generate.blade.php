@extends('layouts/dashboard/main')
@section('page_title', 'Orders Requisitions')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row" ng-controller="RequisitionController" ng-cloak>
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
                                    <li><a href="#" ng-click="remove_item(0, 'index_page', 'selected')"><span class="glyphicon glyphicon-trash"></span> Delete Seleted</a></li>
                                    <li><a href="#" ng-click="remove_item(0, 'index_page', 'all')"><span class="glyphicon glyphicon-repeat"></span> Delete All</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-box-content cnt_a">
                        <div id="main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form method="post" enctype="multipart/form-data" name="myForm" novalidate>
                                        <div class="tabbable" style="padding: 20px;">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab1" data-toggle="tab">Step 1</a></li>
                                            <li><a href="#tab2" data-toggle="tab">Step 2</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                <p>
                                                    <table class="table table-responsive table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>#</th>
                                                        <th>Reference</th>
                                                        <th>Item</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr ng-if="lists.length == 0 || lists.length == 0">
                                                        <td colspan="6">No data found.</td>
                                                    </tr>
                                                    <tr ng-repeat="list in lists" ng-cloak>
                                                        <td><input type="checkbox" ng-model="chkbox" value="## list.id ##" ng-click="select_requisition(list.items_val, list.id)" class="select_row"> </td>
                                                        <td>## $index+1 ##</td>
                                                        <td ng-cloak>## list.requisition_type ## No ## list.reference ## </td>
                                                        <td ng-cloak>## list.item_name ##</td>
                                                        <td ng-cloak>## list.items_val | currency ##</td>
                                                        <td  ng-cloak align="center">
                                                            <a ng-if="list.user_id == {{ Auth::user()->id }}" class="btn btn-danger" ng-click="remove_item(list.id, list.item_name, 'single_delete')" style_name="## style.name ##" style_id="## style.id ##"><i class="glyphicon glyphicon-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    <thead>
                                                    <tr>
                                                        <th colspan="5" class="text-right">
                                                            Total Amount
                                                        </th>
                                                        <th colspan="5" class="text-center">
                                                            ## total_requisition_amount ##
                                                        </th>
                                                    </tr>
                                                    </thead>

                                                    </tbody>
                                                </table>
                                                </p>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <div class="formSep">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <code>Requisition Title *</code>
                                                            <div class="row">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <input class="form-control" placeholder="Requisition Title" name="requisition_title" type="text" ng-model="requisition_title" ng-required="70"/>
                                                            <span class="help-block " ng-show="myForm.requisition_title.$dirty && myForm.requisition_title.$invalid">This field is mandatory.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="formSep">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <code>Send To</code>
                                                            <div class="row">
                                                                &nbsp;&nbsp;
                                                            </div>
                                                            <select class="form-control" ng-model="fowarded_to" ng-pattern="/^\d+$/" ng-required="true">
                                                                <option value="">Select an option</option>
                                                                <option ng-repeat="user in users" value="## user.id ##">
                                                                    ## user.first_name ## ## user.last_name ##
                                                                </option>
                                                            </select><span class="help-block " ng-show="myForm.fowarded_to.$dirty && myForm.fowarded_to.$invalid">Select an option.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="formSep">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <code>Document</code>
                                                            <input ng-model="file" type="file" class="file file-upload" data-preview-file-type="text" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row col-sm-12 text-center">
                                                    <button id="generate_btn" class="btn btn-primary" ng-click='generate_requisition()' ng-disabled="total_requisition_amount == 0 || myForm.$invalid">Generate Requisition</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                @include('production::partials.orders_stats')
            </div>

            <div class="modal fade" id="remove-item-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove Item</h3>
                        </div>
                        <div class="modal-body">
                            ## modal_msg ##
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_item_confirmed(item_id, 'index_page', status)" style_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
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
                            <h3 class="modal-title">Remove Item</h3>
                        </div>
                        <div class="modal-body">
                            Please Select at least one style.
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