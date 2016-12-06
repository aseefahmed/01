@extends('layouts/dashboard/main')
@section('page_title', 'Buyers')

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">{{ Route::currentRouteName() }}</h3>
    </div>
    <div class="row" ng-controller="BuyerController" ng-init="init({{$buyer_id}})">
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
                                    <li><a href="/production/buyer/show/{{ $buyer_id }}" target="_top"><span class="glyphicon glyphicon-arrow-left"></span> Cancel</a></li>
                                    <li><a  ng-if="buyer[0].user_id == {{ Auth::user()->id }}" data-toggle="modal" data-backdrop="static" href="#confirm-buyer-update"><span class="glyphicon glyphicon-pencil"></span> Update</a></li>
                                    <li><a ng-if="buyer[0].user_id == {{ Auth::user()->id }}" class="th-pointer" ng-click="remove_buyer({{ $buyer_id  }}, buyer[0].buyer_name, 'single_delete')"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
                                </ul>
                                &nbsp;
                                <img src="{{ asset('img/loading.gif') }}" style="display: none;" id="ajax-loader">
                            </div>
                        </div>
                    </div>
                    <div class="w-box-content cnt_a">
                        <div id="main-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form id="update-buyer-form" method="post" enctype="multipart/form-data">
                                        <div class="formSep">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <code>Buyer Name </code>
                                                    <div class="row">
                                                        &nbsp;&nbsp;
                                                    </div>
                                                    <input class="form-control" placeholder="Buyer Name" type="text" ng-model="buyer_name" vanlue="buyer[0].buyer_name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="formSep">
                                            <div class="row">
                                            <div class="col-sm-12">
                                                <code>Image </code>
                                                <div class="row">
                                                    &nbsp;&nbsp;
                                                </div>
                                                <img height="20%" src="{{ asset('img/uploads/production/buyers/') }}" width="100%" height="100%">

                                                <input id="buyer_image" name="buyer_image" type="file" class="file file-upload" data-preview-file-type="text" />
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

            <div class="modal fade" id="confirm-buyer-update">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Add Buyer</h3>
                        </div>
                        <div class="modal-body">
                            Do you really want to edit the buyer <code></code> ?
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal">Cancel</a>
                                <button type="submit" name="commit" class="btn btn-success" ng-click="update_buyer('fds')" buyer_id="{{ $buyer_id }}">Yes </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="remove-buyer-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h3 class="modal-title">Remove Buyer</h3>
                        </div>
                        <div class="modal-body">
                            ## modal_msg ##
                            <div class="modal-footer">
                                <a class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span> Cancel</a>
                                <button type="submit" name="commit" class="btn btn-success" ng-click="remove_buyer_confirmed(buyer_id, 'show_page', 'single_delete')" buyer_id=""><span class="glyphicon glyphicon-ok-sign"></span> Yes </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection