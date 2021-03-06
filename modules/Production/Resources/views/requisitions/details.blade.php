@extends('layouts/dashboard/main')
@section('page_title', 'Requisition Details')

@section('content')
    <div class="row col-sm-12" >
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row" ng-controller="AllRequisitionController" ng-init="getRequisitionDetails({{$requisition_id}})" ng-cloak>
        <div class="col-sm-12 col-md-12">
            <div class="col-sm-8">
                <div class="w-box" id="w_sort01">
                    <div class="w-box-header">
                        <div class="pull-left">
                            Requisition ID: {{$requisition_id}}
                        </div>
                    </div>
                    <div class="w-box-content cnt_a">
                        <div id="main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-responsive table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="th-pointer" ng-click="sort('item_name')">Item<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='item_name'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('requisition_type')">Reference<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='requisition_type'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="th-pointer" ng-click="sort('qty')">Qty<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='qty'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="text-right th-pointer" ng-click="sort('items_val')">Requested Amount<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='items_val'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="text-right th-pointer" ng-if="requisitions[0].forwarded_to == {{Auth::user()->id}}" ng-hide="hide_button == 1 || requisitions[0].flag == 2 || requisitions[0].flag == 9" ng-click="sort('items_val')">Approve<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='items_val'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                            <th class="text-right th-pointer" ng-if="requisitions[0].created_by == {{Auth::user()->id}}" ng-click="sort('items_val')">Approved Amount<span class="glyphicon glyphicon-sort-icon"  ng-show="sortKey=='items_val'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-if="requisitions.length == 0 || filtered.length == 0">
                                                <td colspan="6">No data found.</td>
                                            </tr>
                                            <tr dir-paginate="requisition in filtered = (requisitions| orderBy : sortKey : reverse | filter : search_filter  | itemsPerPage : num_of_items) " ng-cloak>
                                                <td ng-cloak>## $index+1 ## </td>
                                                <td ng-cloak>## requisition.item_name ##</td>
                                                <td ng-cloak>## requisition.requisition_type ## ## requisition.reference ##</td>
                                                <td ng-cloak>## requisition.qty ## </td>
                                                <td ng-cloak class="text-right ">## requisition.items_val | currency   ##</td>
                                                <td ng-cloak class="text-right col-sm-2 " ng-if="requisitions[0].forwarded_to == {{Auth::user()->id}}"  ng-hide="hide_button == 1 || requisitions[0].flag == 2 || requisitions[0].flag == 9" ><input type="text" class="form-control" ng-model="approved_amount" ng-blur="add_amount(requisition.requisition_item_id, approved_amount, requisition.item_name, requisition.reference, $index)"></td>
                                                <td ng-cloak class="text-right col-sm-2 " ng-if="requisitions[0].created_by == {{Auth::user()->id}}">
                                                    <span ng-if="requisition.item_flag == 1" class="act act-warning">Pending</span>
                                                    <span ng-if="requisition.item_flag == 9 || (requisition.item_flag == 2 && requisition.item_approved_amount == 0)" class="act act-danger">Rejected</span>
                                                    <span ng-if="requisition.item_flag == 2 && requisition.item_approved_amount > 0" class="act act-success">## requisition.item_approved_amount | currency ##</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                        <tr>
                                            <th colspan="4" class="text-right">Total </th>
                                            <th class="text-right">## requisitions[0].requested_amount | currency ## </th>
                                            <th ng-if="requisitions[0].forwarded_to == {{Auth::user()->id}}"  ng-hide="hide_button == 1 || requisitions[0].flag == 2 || requisitions[0].flag == 9" class="text-right">## total_approved_amount | currency ##</th>
                                            <th ng-if="requisitions[0].created_by == {{Auth::user()->id}}" class="text-right">## get_total_approved_amount() | currency ##</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <div class="row">
                                        &nbsp;
                                    </div>
                                    <div class="formSep" ng-if="requisitions[0].forwarded_to == {{Auth::user()->id}}">
                                        <button class="btn btn-primary"  ng-hide="hide_button == 1 || requisitions[0].flag == 2 || requisitions[0].flag == 9">Clear</button>
                                        <button class="btn btn-danger" ng-click="act_on_requisition(requisitions[0].id,total_approved_amount,9,items)" ng-hide="hide_button == 1 || requisitions[0].flag == 2 || requisitions[0].flag == 9">Reject</button>
                                        <button class="btn btn-success" ng-disabled="total_approved_amount == 0" ng-click="act_on_requisition(requisitions[0].id, total_approved_amount,2,items)" ng-hide="hide_button == 1 || requisitions[0].flag == 2 || requisitions[0].flag == 9">Approved</button>
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

            <div class="modal fade" id="add-requisition-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Add requisition</h3>
                        </div>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data" name="myForm" novalidate>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>requisition</code><span style="color:red">*</span>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="requisition" name="requisition_name" type="text" ng-model="requisition_name" ng-required="true" ng-maxlength="50">
                                            <span class="help-block " ng-show="myForm.requisition_name.$dirty && myForm.requisition_name.$invalid">This is a mendatory field (Maximum: 50 Characters).</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Postal Address</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Postal Address" name="postal_address" type="text" ng-model="postal_address" ng-maxlength="70"/>
                                            <span class="help-block " ng-show="myForm.postal_address.$dirty && myForm.postal_address.$invalid">This field not be more than 70 characters long.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Contact Person</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Contact Person" type="text" name="contact_person" ng-model="contact_person" ng-maxlength="55"/>
                                            <span class="help-block " ng-show="myForm.contact_person.$dirty && myForm.contact_person.$invalid">It must not be more than 55 characters long.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <code>Email Address</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Email Address" name="email" type="text" ng-model="email_address" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/"/>
                                            <span class="help-block " ng-show="myForm.email.$dirty && myForm.email.$invalid">Email address must be valid.</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <code>Contact Number</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Contact Number" type="text" name="contact_number" ng-model="contact_number" ng-maxlength="20"/>
                                            <span class="help-block " ng-show="myForm.contact_number.$dirty && myForm.contact_number.$invalid">It must not be more than 20 characters long.</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Website</code>
                                            <div class="row">
                                                &nbsp;&nbsp;
                                            </div>
                                            <input class="form-control" placeholder="Website" type="text" ng-model="website"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="formSep">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <code>Image</code>
                                            <input ng-model="file" type="file" class="file file-upload" data-preview-file-type="text" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                    <button type="submit" ng-disabled="myForm.$invalid" name="commit" class="btn btn-success" ng-click="add_requisition()"><span class="glyphicon glyphicon-ok-sign"></span> Add requisition </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="remove-requisition-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove requisition</h3>
                        </div>
                        <div class="modal-body">
                            ## modal_msg ##
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_requisition_confirmed(requisition_id, 'index_page', status)" requisition_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
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
                            <h3 class="modal-title">Remove requisition</h3>
                        </div>
                        <div class="modal-body">
                            Please Select at least one requisition.
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